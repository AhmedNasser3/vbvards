<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function AllCoupon(){
        $coupon = Coupon::latest()->get();
        return view('admin.coupon.coupon_all',compact('coupon'));
    } // End Method


    public function AddCoupon(){
        return view('admin.coupon.coupon_add');
    }// End Method


public function StoreCoupon(Request $request){

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);

    }// End Method


    public function EditCoupon($id){

        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit_coupon',compact('coupon'));

    }// End Method


    public function UpdateCoupon(Request $request){

        $coupon_id = $request->id;

         Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);


    }// End Method

     public function DeleteCoupon($id){

        Coupon::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method

    public function ApplyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)
                        ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                        ->first();

        if ($coupon) {
            $cartTotal = Cart::where('user_id', Auth::id())->get()->sum(function($item){
                return ($item->product->discount_price ?? $item->product->selling_price) * $item->quantity; // تأكد من أن الكمية تُحسب بشكل صحيح
            });

            $discountAmount = $cartTotal * $coupon->coupon_discount / 100; // حساب قيمة الخصم
            $totalAfterDiscount = $cartTotal - $discountAmount;

            // تخزين القيم في الجلسة (Session)
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'discount' => $coupon->coupon_discount,
                'subtotal' => $cartTotal,
                'discount_amount' => $discountAmount, // إضافة مبلغ الخصم
                'total' => round($totalAfterDiscount, 2) // التأكد من حساب المجموع النهائي بعد الخصم
            ]);

            return response()->json([
                'valid' => true,
                'message' => 'Coupon applied successfully'
            ]);
        } else {
            return response()->json([
                'valid' => false,
                'message' => 'Coupon is invalid or expired'
            ]);
        }
    }


public function CouponCalculation()
{
    if (Session::has('coupon')) {
        return response()->json([
            'subtotal' => Session::get('coupon')['subtotal'],
            'coupon_name' => Session::get('coupon')['coupon_name'],
            'discount' => Session::get('coupon')['discount'],
            'total' => Session::get('coupon')['total']
        ]);
    } else {
        $cartTotal = Cart::where('user_id', Auth::id())->get()->sum(function($item){
            return ($item->product->discount_price ?? $item->product->selling_price) * $item->qty;
        });

        return response()->json([
            'subtotal' => $cartTotal,
            'total' => $cartTotal
        ]);
    }
}

public function CouponRemove()
{
    Session::forget('coupon');
    return response()->json(['success' => 'Coupon Removed']);
}

}