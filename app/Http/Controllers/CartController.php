<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
{
    // Check if coupon exists and clear it
    if (Session::has('coupon')) {
        Session::forget('coupon');
    }

    // Get the product from the database
    $product = Product::findOrFail($id);

    // Create the cart item
    $cartItem = [
        'product_name' => $request->product_name,
        'quantity' => $request->quantity,
        'price' => $product->discount_price ?? $product->selling_price,
        'color' => $request->color,
        'size' => $request->size,
        'vendor' => $request->vendor,
        'image' => $product->product_thambnail,
        'product_id' => $id,
        'user_id' => auth()->id(), // Associate the cart with the logged-in user
    ];

    // Store the product in the database (if needed)
    Cart::create($cartItem);

    // Store the product in the session (if using session-based cart)
    $cart = Session::get('cart', []);
    $cart[$id] = $cartItem;
    Session::put('cart', $cart);

    return response()->json(['success' => 'Successfully Added to Your Cart']);
}



    public function AddMiniCart(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal

        ));
    }// End Method



    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);

    }// End Method


    public function MyCart(){
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $subtotal = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('frontend.mycart.view_mycart',compact('cartItems'));

    }// End Method


    public function GetCartProduct(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal

        ));

    }// End Method
    public function CartRemove($rowId)
    {
        // تحديث السلة لإزالة العنصر

            $cart = Cart::findOrFail($rowId);



            $cart->delete();

        // إعادة توجيه المستخدم بعد الحذف مع رسالة النجاح
        return redirect()->back()->with('success', 'تم إزالة العنصر بنجاح من السلة');
    }





    public function CartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty -1);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
            ]);
        }


        return response()->json('Decrement');

    }// End Method


     public function CartIncrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty +1);

          if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
            ]);
        }

        return response()->json('Increment');

    }// End Method



    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'

            ));


        } else{
            return response()->json(['error' => 'Invalid Coupon']);
        }

    }// End Method


    public function CouponCalculation(){

        if (Session::has('coupon')) {

            return response()->json(array(
             'subtotal' => Cart::total(),
             'coupon_name' => session()->get('coupon')['coupon_name'],
             'coupon_discount' => session()->get('coupon')['coupon_discount'],
             'discount_amount' => session()->get('coupon')['discount_amount'],
             'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }// End Method

    public function CouponRemove(){

        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);

    }// End Method


    public function CheckoutCreate(){

        if (Auth::check()) {

            if (Cart::total() > 0) {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        $divisions = ShipDivision::orderBy('division_name','ASC')->get();

        return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));


            }else{

            $notification = array(
            'message' => 'Shopping At list One Product',
            'alert-type' => 'error'
        );

        return redirect()->to('/')->with($notification);
            }



        }else{

             $notification = array(
            'message' => 'You Need to Login First',
            'alert-type' => 'error'
        );

        return redirect()->route('login')->with($notification);
        }




    }// End Method


}