<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $skip_category_0 = Category::skip(0)->first();
        if ($skip_category_0) {
            $skip_product_0 = Product::where('status', 1)
                ->where('category_id', $skip_category_0->id)
                ->orderBy('id', 'DESC')
                ->limit(5)
                ->get();
        } else {
            $skip_product_0 = collect(); // مجموعة فارغة لتفادي الأخطاء لاحقًا
        }

        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2 = collect(); // تعيين قائمة فارغة افتراضيًا

        if ($skip_category_2) {
            $skip_product_2 = Product::where('status',1)
                ->where('category_id', $skip_category_2->id)
                ->orderBy('id','DESC')
                ->limit(5)
                ->get();
        }


        $skip_category_7 = Category::skip(7)->first();
        $skip_product_7 = Product::where('status', 1)
            ->where('category_id', optional($skip_category_7)->id)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();

        $special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();

        $new = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();

        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.home.index',compact('skip_category_0','skip_product_0','skip_category_2','skip_product_2','skip_category_7','skip_product_7','hot_deals','special_offer','new','special_deals'));    }
    public function ProductDetails($id,$slug){

        $product = Product::findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $multiImage = MultiImg::where('product_id',$id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();

        return view('frontend.product.product_details',compact('product','product_color','product_size','multiImage','relatedProduct'));

     } // End Method
     public function CatWiseProduct(Request $request,$id,$slug){
        $products = Product::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();

        $breadcat = Category::where('id',$id)->first();

        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

        return view('frontend.product.category_view',compact('products','categories','breadcat','newProduct'));

       }// End Method
       public function SubCatWiseProduct(Request $request,$id,$slug){
        $products = Product::where('status',1)->where('subcategory_id',$id)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name','ASC')->get();

        $breadsubcat = SubCategory::where('id',$id)->first();

        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

        return view('frontend.product.subcategory_view',compact('products','categories','breadsubcat','newProduct'));

       }// End Method
       public function ProductViewAjax($id)
       {
           $product = Product::with('category', 'brand')->findOrFail($id);
           $color = $product->product_color;
           $product_color = explode(',', $color);

           $size = $product->product_size;
           $product_size = explode(',', $size);

           return response()->json([
               'product' => $product,
               'color' => $product_color,
               'size' => $product_size,
           ]);
       }
       // End Method
}