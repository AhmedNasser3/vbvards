<?php

namespace App\Http\Controllers;

use Image;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use App\Models\RechargeCard;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->get();
        return view('admin.product.product_all',compact('products'));
    }

    public function AddProduct(){
        $activeVendor = User::latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.product.product_add',compact('brands','categories','activeVendor'));
    }

    public function StoreProduct(Request $request){
        $image = $request->file('product_thambnail');
        $path = $image->store('products/thambnail', 'public');

        $product_id = Product::insertGetId([
  'brand_id' => $request->brand_id,
    'category_id' => $request->category_id,
    'subcategory_id' => $request->subcategory_id,
    'subsubcategory_id' => $request->subsubcategory_id,
    'product_name' => $request->product_name,
    'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
    'product_code' => $request->product_code,
    'product_qty' => $request->product_qty,
    'product_tags' => $request->product_tags,
    'product_size' => $request->product_size,
    'product_color' => $request->product_color,
    'selling_price' => $request->selling_price,
    'discount_price' => $request->discount_price,
    'short_descp' => $request->short_descp,
    'long_descp' => $request->long_descp,
    'hot_deals' => $request->hot_deals,
    'featured' => $request->featured,
    'special_offer' => $request->special_offer,
    'special_deals' => $request->special_deals,
    'product_thambnail' => 'storage/' . $path,
    'vendor_id' => $request->vendor_id,
    'status' => 1,
    'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $img) {
                $multiPath = $img->store('products/multi-image', 'public');
                MultiImg::create([
                    'product_id' => $product_id,
                    'photo_name' => 'storage/' . $multiPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return redirect()->route('all.product')->with('success', 'Product Inserted Successfully');
    }
    public function EditProduct($id){

        $multiImgs = MultiImg::where('product_id',$id)->get();
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
         $brands = Brand::latest()->get();
         $categories = Category::latest()->get();
         $subcategories = SubCategory::latest()->get();
         $subsubcategories = SubSubCategory::latest()->get();
         $product = Product::findOrFail($id);
         return view('admin.product.product_edit',compact('brands','categories','activeVendor','product','subsubcategories','multiImgs','subcategories'));
     }// End Method
     public function UpdateProduct(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // تحديث البيانات الأساسية
    $product->update([
        'brand_id' => $request->brand_id,
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'subsubcategory_id' => $request->subsubcategory_id,
        'product_name' => $request->product_name,
        'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
        'product_code' => $request->product_code,
        'product_qty' => $request->product_qty,
        'product_tags' => $request->product_tags,
        'product_size' => $request->product_size,
        'product_color' => $request->product_color,
        'selling_price' => $request->selling_price,
        'discount_price' => $request->discount_price,
        'short_descp' => $request->short_descp,
        'long_descp' => $request->long_descp,
        'hot_deals' => $request->hot_deals,
        'featured' => $request->featured,
        'special_offer' => $request->special_offer,
        'special_deals' => $request->special_deals,
        'vendor_id' => $request->vendor_id,
        'updated_at' => Carbon::now(),
    ]);

    // تحديث الصورة المصغرة (إذا تم رفع صورة جديدة)
    if ($request->hasFile('product_thambnail')) {
        // حذف الصورة القديمة
        Storage::disk('public')->delete(str_replace('storage/', '', $product->product_thambnail));

        // حفظ الصورة الجديدة
        $image = $request->file('product_thambnail');
        $path = $image->store('products/thambnail', 'public');

        $product->update([
            'product_thambnail' => 'storage/' . $path,
        ]);
    }

    // تحديث الصور المتعددة (إذا تم رفع صور جديدة)
    if ($request->hasFile('multi_img')) {
        // حذف الصور القديمة
        $oldImages = MultiImg::where('product_id', $id)->get();
        foreach ($oldImages as $oldImg) {
            Storage::disk('public')->delete(str_replace('storage/', '', $oldImg->photo_name));
            $oldImg->delete();
        }

        // إضافة الصور الجديدة
        foreach ($request->file('multi_img') as $img) {
            $multiPath = $img->store('products/multi-image', 'public');
            MultiImg::create([
                'product_id' => $id,
                'photo_name' => 'storage/' . $multiPath,
                'created_at' => Carbon::now(),
            ]);
        }
    }

    return redirect()->route('all.product')->with('success', 'Product Updated Successfully');
}

    public function UpdateProductThambnail(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product->product_thambnail) {
            Storage::disk('public')->delete(str_replace('storage/', '', $product->product_thambnail));
        }

        $path = $request->file('product_thambnail')->store('products/thambnail', 'public');
        $product->update(['product_thambnail' => 'storage/' . $path]);

        return redirect()->back()->with('success', 'Thumbnail Updated Successfully');
    }

    public function UpdateProductMultiimage(Request $request){
        foreach($request->multi_img as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            Storage::disk('public')->delete(str_replace('storage/', '', $imgDel->photo_name));

            $multiPath = $img->store('products/multi-image', 'public');
            MultiImg::where('id', $id)->update([
                'photo_name' => 'storage/' . $multiPath,
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->back()->with('success', 'Product Multi Image Updated Successfully');
    }

    public function MulitImageDelete($id){
        $oldImg = MultiImg::findOrFail($id);
        Storage::disk('public')->delete(str_replace('storage/', '', $oldImg->photo_name));
        $oldImg->delete();

        return redirect()->back()->with('success', 'Product Multi Image Deleted Successfully');
    }
    public function ProductInactive($id){

        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method
    public function ProductActive($id){

        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method
    public function ProductDelete($id){
        $product = Product::findOrFail($id);
        Storage::disk('public')->delete(str_replace('storage/', '', $product->product_thambnail));
        $product->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            Storage::disk('public')->delete(str_replace('storage/', '', $img->photo_name));
            $img->delete();
        }

        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
    public function ProductStock(){

        $products = Product::latest()->get();
        return view('admin.product.product_stock',compact('products'));

    }// End Method
    public function GetSubSubCategory($subcategory_id){
        $subsubcategories = SubSubCategory::where('subcategory_id', $subcategory_id)->get();
        return response()->json($subsubcategories);
    }


    // ----------------------- recharge cards -----------------------

    public function AllRecharge()
    {
        $recharges = RechargeCard::latest()->get();
        return view('admin.recharge.recharge_all', compact('recharges'));
    }

    public function AddRecharge()
    {
        $products = product::all();
        return view('admin.recharge.recharge_add',compact('products'));
    }

    public function StoreRecharge(Request $request)
    {
        RechargeCard::create([
            'name' => $request->name,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('all.recharge')->with('success', 'تم إضافة بطاقة شحن جديدة بنجاح');
    }

    public function EditRecharge($id)
    {
        $recharge = RechargeCard::findOrFail($id);
        $products = Product::latest()->get(); // أو حسب ما تسمي جدول المنتجات في مشروعك
        return view('admin.recharge.recharge_edit', compact('recharge', 'products'));
    }


    public function UpdateRecharge(Request $request)
    {
        $recharge = RechargeCard::findOrFail($request->id);
        $recharge->update([
            'name' => $request->name,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('all.recharge')->with('success', 'تم تعديل البطاقة بنجاح');
    }

    public function DeleteRecharge($id)
    {
        RechargeCard::findOrFail($id)->delete();
        return redirect()->route('all.recharge')->with('success', 'تم حذف البطاقة بنجاح');
    }
    public function storeExcel(Request $request)
{
    // التحقق من وجود الملف
    if ($request->hasFile('excel_file')) {
        $file = $request->file('excel_file');

        // قراءة الملف باستخدام PhpSpreadsheet
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();

        // تحويل البيانات إلى مصفوفة
        $data = $sheet->toArray();

        // تخزين الأكواد في قاعدة البيانات
        foreach ($data as $row) {
            // التحقق من أن البيانات ليست فارغة أو مكررة
            if (!empty($row[0]) && !empty($row[1])) {
                RechargeCard::create([
                    'name' => $row[0],  // العمود الأول (اسم البطاقة)
                    'product_id' => $row[1],  // العمود الثاني (product_id)
                ]);
            }
        }

        // إعادة التوجيه مع رسالة النجاح
        return redirect()->route('all.recharge')->with('success', 'تم إضافة الأكواد بنجاح');
    }

    // في حالة عدم وجود ملف
    return back()->with('error', 'يرجى رفع ملف Excel');
}
}
