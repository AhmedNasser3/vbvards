<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function AllBanner()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner.banner_all', compact('banners'));
    }

    public function AddBanner()
    {
        return view('admin.banner.banner_add');
    }

    public function StoreBanner(Request $request)
    {
        $request->validate([
            'banner_title'  => 'required|string|max:255',
            'banner_url'    => 'nullable|url',
            'banner_image'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('banner_image')->store('banner', 'public');
        $filename = str_replace('public/', '', $path);

        Banner::create([
            'banner_title' => $request->banner_title,
            'banner_url'   => $request->banner_url,
            'banner_image' => $filename,
        ]);

        return redirect()->route('all.banner')->with([
            'message'    => 'تمت إضافة البانر بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function EditBanner($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.banner_edit', compact('banner'));
    }

    public function UpdateBanner(Request $request, $id)
    {
        $request->validate([
            'banner_title'  => 'required|string|max:255',
            'banner_url'    => 'nullable|url',
            'banner_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $banner = Banner::findOrFail($id);
        $oldImage = $banner->banner_image;

        if ($request->hasFile('banner_image')) {
            if ($oldImage && Storage::exists('public/' . $oldImage)) {
                Storage::delete('public/' . $oldImage);
            }

            $path = $request->file('banner_image')->store('banner', 'public');
            $banner->banner_image = str_replace('public/', '', $path);
        }

        $banner->update([
            'banner_title' => $request->banner_title,
            'banner_url'   => $request->banner_url,
            'banner_image' => $banner->banner_image,
        ]);

        return redirect()->route('all.banner')->with([
            'message'    => 'تم تحديث البانر بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteBanner($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->banner_image && Storage::exists('public/' . $banner->banner_image)) {
            Storage::delete('public/' . $banner->banner_image);
        }

        $banner->delete();

        return redirect()->back()->with([
            'message'    => 'تم حذف البانر بنجاح',
            'alert-type' => 'success'
        ]);
    }
}
