<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    private $apiId = 'APP_ID_1123453311';
    private $secretKey = '0662abb5-13c7-38ab-cd12-236e58f43766';

    public function createPayment(Request $request)
    {
        // استرجاع المنتجات في سلة المستخدم
        $finalPrice = Cart::where('user_id', Auth::id())->with('product')->get();

        // حساب السعر الإجمالي قبل الخصم
        $totalPrice = 0;
        foreach ($finalPrice as $item) {
            // إذا كان هناك خصم، قم بحسابه
            if ($item->product->discount_price) {
                $totalPrice += ($item->product->discount_price) * $item->quantity;
            } else {
                // إذا لم يكن هناك خصم، قم بحساب السعر الكامل
                $totalPrice += $item->product->selling_price * $item->quantity;
            }
        }

        // تحقق إذا كان هناك كوبون مفعّل
        if (Session::has('coupon')) {
            // استرجاع تفاصيل الكوبون
            $coupon = Session::get('coupon');

            // تحقق مما إذا كان الكوبون يحتوي على المفتاح 'type' و 'discount'
            if (isset($coupon['type']) && isset($coupon['discount'])) {
                // حساب الخصم بناءً على الكوبون
                $discountAmount = 0;
                if ($coupon['type'] == 'percentage') {
                    // خصم بنسبة مئوية
                    $discountAmount = ($totalPrice * $coupon['discount']) / 100;
                } elseif ($coupon['type'] == 'fixed') {
                    // خصم بمبلغ ثابت
                    $discountAmount = $coupon['discount'];
                }

                // تطبيق الخصم على السعر النهائي
                $totalPrice -= $discountAmount;

                // تسجيل الخصم
                Log::info('تم تطبيق خصم الكوبون', ['discountAmount' => $discountAmount, 'totalPrice' => $totalPrice]);
            } else {
                // في حال لم يكن هناك مفتاح 'type' أو 'discount' في الكوبون
                Log::error('الكوبون لا يحتوي على نوع صالح أو خصم', $coupon);
            }
        }

        // تحقق من السعر النهائي بعد تطبيق الخصم
        Log::info('السعر النهائي بعد الخصم: ', ['totalPrice' => $totalPrice]);

        // التوثيق
        $authResponse = Http::withOptions([
            'verify' => false
        ])->post('https://restpilot.paylink.sa/api/auth', [
            'apiId' => $this->apiId,
            'persistToken' => false,
            'secretKey' => $this->secretKey
        ]);

        $data = $authResponse->json();

        if (!$authResponse->successful() || !isset($data['id_token'])) {
            return response()->json([
                'error' => 'فشل في التوثيق',
                'details' => $data
            ], 500);
        }

        $token = $data['id_token'];

        // إنشاء الفاتورة
        $invoiceResponse = Http::withToken($token)->withOptions([
            'verify' => false
        ])->post('https://restpilot.paylink.sa/api/addInvoice', [
            "amount" => $totalPrice,  // إضافة 5 كرسوم خدمة أو شحن
            "callBackUrl" => "http://127.0.0.1:8000/payment-success",
            "cancelUrl" => "http://127.0.0.1:8000/payment-cancel",
            "clientEmail" => auth()->user()->email,
            "clientMobile" => auth()->user()->phone,
            "clientName" => auth()->user()->first_name,
            "currency" => "SAR",
            "note" => "فاتورة لعميل مميز جداً",
            "orderNumber" => "ORDER-" . uniqid(),
            "products" => [
                [
                    "description" => "شنطة جلد بنية راقية",
                    "imageSrc" => "https://merchantwebsite.com/images/bag.jpg",
                    "isDigital" => false,
                    "price" => $totalPrice,
                    "productCost" => 0,
                    "qty" => 4,
                    "specificVat" => 0,
                    "title" => "شنطة جلد"
                ]
            ]
        ]);

        $invoiceData = $invoiceResponse->json();

        // فحص النجاح بناءً على وجود رابط الفاتورة
        if (!$invoiceResponse->successful() || !isset($invoiceData['url'])) {
            $errorMessage = $invoiceData['error']
                ?? ($invoiceData['paymentErrors'][0] ?? null)
                ?? 'فشل في إنشاء الفاتورة بدون تفاصيل إضافية';

            return response()->json([
                'error' => $errorMessage,
                'details' => $invoiceData
            ], 500);
        }

        // إعادة التوجيه إلى رابط الفاتورة
        return redirect($invoiceData['url']);
    }

    public function paymentSuccess()
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response("<h2 style='color: orange; text-align: center; margin-top: 50px;'>🛒 السلة فارغة! لا توجد عملية شراء.</h2>", 200)
                ->header('Content-Type', 'text/html');
        }

        $orderNumber = 'ORDER-' . strtoupper(uniqid());
        $invoiceNo = 'INV-' . mt_rand(100000, 999999);
        $today = now();

        $totalAmount = 0;

        foreach ($cartItems as $item) {
            $price = $item->product->discount_price ?? $item->product->selling_price;
            $totalAmount += $price * $item->quantity;
        }

        // 🔁 محاولة اختيار بطاقة شحن متاحة لأي منتج موجود في السلة
        $productIds = $cartItems->pluck('product_id')->toArray();
        $rechargeCard = \DB::table('recharge_cards')
            ->whereIn('product_id', $productIds)
            ->where('status', 'available') // التأكد من أن البطاقة متاحة
            ->first();

        $rechargeCardName = $rechargeCard?->name ?? null;
        $rechargeCardId = $rechargeCard?->id ?? null;  // استخراج الـ ID الخاصة بالبطاقة
        $product = $cartItems->first()->product;  // أخذ المنتج الأول من السلة، يمكن تعديلها إذا كنت بحاجة إلى التعامل مع أكثر من منتج

        // 🧾 إنشاء الطلب
        $orderId = \DB::table('orders')->insertGetId([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'division_id' => 0,
            'district_id' => 0,
            'state_id' => 0,
            'name' => $user->first_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'adress' => '---',
            'post_code' => '---',
            'notes' => '',
            'payment_type' => 'Paylink',
            'payment_method' => 'Paylink',
            'transaction_id' => null,
            'currency' => 'SAR',
            'amount' => $totalAmount,
            'recharge_card_id' => $rechargeCardId,  // إضافة الـ ID الخاصة بالبطاقة
            'order_number' => $orderNumber,
            'invoice_no' => $invoiceNo,
            'order_date' => $today->format('Y-m-d'),
            'order_month' => $today->format('F'),
            'order_year' => $today->format('Y'),
            'status' => 'pending',
            'created_at' => $today,
            'updated_at' => $today,
        ]);

        // 🧾 إدخال المنتجات في order_items
        foreach ($cartItems as $item) {
            $product = $item->product;
            $price = $product->discount_price ?? $product->selling_price;

            \DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $product->id,
                'vendor_id' => $product->vendor_id ?? null,
                'color' => $item->color ?? null,
                'size' => $item->size ?? null,
                'qty' => $item->quantity,
                'price' => $price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // تقليل الكمية في المخزون
            $product->product_qty = max(0, $product->product_qty - $item->quantity);
            $product->save();
        }

        // ✅ تحديث البطاقة على أنها "مستخدمة" بعد إضافتها للطلب
        if ($rechargeCard) {
            \DB::table('recharge_cards')
                ->where('id', $rechargeCard->id)
                ->update(['status' => 'used']);
        }

        // 🧹 حذف محتويات السلة
        Cart::where('user_id', $user->id)->delete();

        return redirect('/mycart')->with('success', '✅ تم الدفع بنجاح وتم تسجيل الطلب رقم: ' . $orderNumber);
    }


    public function paymentCancel()
    {
        return response("<h2 style='color: red; text-align: center; margin-top: 50px;'>❌ تم إلغاء الدفع. لم يتم تنفيذ العملية.</h2>", 200)
            ->header('Content-Type', 'text/html');
    }
}
