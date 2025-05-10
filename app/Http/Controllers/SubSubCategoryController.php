<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    public function AllSubSubCategory()
    {
        $subsubcategories = SubSubCategory::latest()->get();
        return view('admin.subsubcategory.subsubcategory_all', compact('subsubcategories'));
    }

    public function AddSubSubCategory()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('admin.subsubcategory.subsubcategory_add', compact('categories'));
    }

    public function StoreSubSubCategory(Request $request)
    {
        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            'subsubcategory_slug' => strtolower(str_replace(' ', '-', $request->subsubcategory_name)),
        ]);

        $notification = array(
            'message' => 'Sub-SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subsubcategory')->with($notification);
    }

    public function EditSubSubCategory($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subsubCategory = SubSubCategory::findOrFail($id);
        return view('admin.subsubcategory.subsubcategory_edit', compact('categories', 'subsubCategory'));
    }

    public function UpdateSubSubCategory(Request $request)
    {
        $subsubcat_id = $request->id;

        SubSubCategory::findOrFail($subsubcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            'subsubcategory_slug' => strtolower(str_replace(' ', '-', $request->subsubcategory_name)),
        ]);

        $notification = array(
            'message' => 'Sub-SubCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subsubcategory')->with($notification);
    }

    public function DeleteSubSubCategory($id)
    {
        SubSubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub-SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function GetSubSubCategory($category_id)
    {
        $subsubcat = SubSubCategory::where('category_id', $category_id)
            ->orderBy('subsubcategory_name', 'ASC')->get();
        return json_encode($subsubcat);
    }
}