<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.brand_all', compact('brands'));
    }

    public function AddBrand()
    {
        return view('admin.brand.brand_add');
    }

    public function StoreBrand(Request $request)
    {
        $request->validate([
            'brand_name'  => 'required|string|max:255',
            'brand_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // حفظ الصورة في storage/app/public/brand
        $path = $request->file('brand_image')->store('brand', 'public');
        $filename = str_replace('public/', '', $path); // حفظ المسار النسبي فقط

        Brand::create([
            'brand_name'  => $request->brand_name,
            'brand_slug'  => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $filename,
        ]);

        return redirect()->route('all.brand')->with([
            'message'    => 'تمت إضافة العلامة التجارية بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function EditBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.brand_edit', compact('brand'));
    }

    public function UpdateBrand(Request $request, $id)
    {
        $request->validate([
            'brand_name'  => 'required|string|max:255',
            'brand_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $brand = Brand::findOrFail($id);
        $oldImage = $brand->brand_image;

        if ($request->hasFile('brand_image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($oldImage && Storage::exists('public/' . $oldImage)) {
                Storage::delete('public/' . $oldImage);
            }

            // حفظ الصورة الجديدة
            $path = $request->file('brand_image')->store('brand', 'public');
            $brand->brand_image = str_replace('public/', '', $path);
        }

        $brand->update([
            'brand_name'  => $request->brand_name,
            'brand_slug'  => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $brand->brand_image,
        ]);

        return redirect()->route('all.brand')->with([
            'message'    => 'تم تحديث العلامة التجارية بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteBrand($id)
    {
        $brand = Brand::findOrFail($id);

        // حذف الصورة من التخزين إذا كانت موجودة
        if ($brand->brand_image && Storage::exists('public/' . $brand->brand_image)) {
            Storage::delete('public/' . $brand->brand_image);
        }

        $brand->delete();

        return redirect()->back()->with([
            'message'    => 'تم حذف العلامة التجارية بنجاح',
            'alert-type' => 'success'
        ]);
    }
}
