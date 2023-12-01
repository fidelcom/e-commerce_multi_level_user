<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Slider::latest()->get();
        return view('backend.slider.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $img = $request->file('image');
//            unlink(public_path('upload/admin/profile/'.Auth::user()->photo));
        $filename = Str::uuid().'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(2376, 807)->save('upload/slider/'.$filename);
        $filename_save = 'upload/slider/'.$filename;

        Slider::create([
            'title' => $request->title,
            'short_title' => $request->short_title,
            'image' => $filename_save
        ]);

        return redirect()->route('slider.index')->with([
            'message' => 'Slider created successfully!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Slider::findOrFail($id);
        return view('backend.slider.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        if ($request->file('image')){
            $img = $request->file('image');
            $filename = Str::uuid().'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(2376, 807)->save('upload/slider/'.$filename);
            $filename_save = 'upload/slider/'.$filename;

            if(file_exists(Slider::findOrFail($id)->image))
            {
                unlink(Slider::findOrFail($id)->image);
            }

            Slider::where('id', $id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'image' => $filename_save
            ]);

            return redirect()->route('slider.index')->with([
                'message' => 'Slider updated successfully!',
                'alert-type' => 'success'
            ]);
        }

        Slider::where('id', $id)->update([
            'title' => $request->title,
            'short_title' => $request->short_title,
        ]);

        return redirect()->route('slider.index')->with([
            'message' => 'Slider updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Slider::findOrFail($id);
        if(file_exists($data->image))
        {
            unlink($data->image);
        }
        $data->delete();
        return redirect()->route('slider.index')->with([
            'message' => 'Product Category deleted successfully!',
            'alert-type' => 'success'
        ]);
    }
}
