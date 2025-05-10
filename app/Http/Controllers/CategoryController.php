<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $categories = Category::latest()->get();
        return view('admin.category.category_all', compact('categories'));
    }

    public function AddCategory()
    {
        return view('admin.category.category_add');
    }

    public function StoreCategory(Request $request)
    {
        $request->validate([
            'category_name'  => 'required|string|max:255',
            'category_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // حفظ الصورة في storage/app/public/category
        $path = $request->file('category_image')->store('category', 'public');
        $filename = str_replace('public/', '', $path);

        Category::create([
            'category_name'  => $request->category_name,
            'category_slug'  => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_image' => $filename,
        ]);

        return redirect()->route('all.category')->with([
            'message'    => 'تمت إضافة الفئة بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.category_edit', compact('category'));
    }

    public function UpdateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name'  => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $oldImage = $category->category_image;

        if ($request->hasFile('category_image')) {
            if ($oldImage && Storage::exists('public/' . $oldImage)) {
                Storage::delete('public/' . $oldImage);
            }

            $path = $request->file('category_image')->store('category', 'public');
            $category->category_image = str_replace('public/', '', $path);
        }

        $category->update([
            'category_name'  => $request->category_name,
            'category_slug'  => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_image' => $category->category_image,
        ]);

        return redirect()->route('all.category')->with([
            'message'    => 'تم تحديث الفئة بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteCategory($id)
    {
        $category = Category::findOrFail($id);

        if ($category->category_image && Storage::exists('public/' . $category->category_image)) {
            Storage::delete('public/' . $category->category_image);
        }

        $category->delete();

        return redirect()->back()->with([
            'message'    => 'تم حذف الفئة بنجاح',
            'alert-type' => 'success'
        ]);
    }
}