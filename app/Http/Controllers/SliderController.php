<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function AllSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.slider_all', compact('sliders'));
    }

    public function AddSlider()
    {
        return view('admin.slider.slider_add');
    }

    public function StoreSlider(Request $request)
    {
        $request->validate([
            'slider_title' => 'required|string|max:255',
            'short_title'  => 'nullable|string|max:255',
            'slider_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('slider_image')->store('slider', 'public');
        $filename = str_replace('public/', '', $path);

        Slider::create([
            'slider_title' => $request->slider_title,
            'short_title'  => $request->short_title,
            'slider_image' => $filename,
        ]);

        return redirect()->route('all.slider')->with([
            'message'    => 'تمت إضافة السلايدر بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function EditSlider($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.slider_edit', compact('slider'));
    }

    public function UpdateSlider(Request $request, $id)
    {
        $request->validate([
            'slider_title' => 'required|string|max:255',
            'short_title'  => 'nullable|string|max:255',
            'slider_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slider = Slider::findOrFail($id);
        $oldImage = $slider->slider_image;

        if ($request->hasFile('slider_image')) {
            if ($oldImage && Storage::exists('public/' . $oldImage)) {
                Storage::delete('public/' . $oldImage);
            }

            $path = $request->file('slider_image')->store('slider', 'public');
            $slider->slider_image = str_replace('public/', '', $path);
        }

        $slider->update([
            'slider_title' => $request->slider_title,
            'short_title'  => $request->short_title,
            'slider_image' => $slider->slider_image,
        ]);

        return redirect()->route('all.slider')->with([
            'message'    => 'تم تحديث السلايدر بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function DeleteSlider($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->slider_image && Storage::exists('public/' . $slider->slider_image)) {
            Storage::delete('public/' . $slider->slider_image);
        }

        $slider->delete();

        return redirect()->back()->with([
            'message'    => 'تم حذف السلايدر بنجاح',
            'alert-type' => 'success',
        ]);
    }
}
