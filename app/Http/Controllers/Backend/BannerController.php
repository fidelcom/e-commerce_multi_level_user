<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::latest()->get();
        return view('backend.banner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.create');
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
        Image::make($img)->resize(768, 450)->save('upload/banner/'.$filename);
        $filename_save = 'upload/banner/'.$filename;

        Banner::create([
            'title' => $request->title,
            'url' => $request->url,
            'image' => $filename_save
        ]);

        return redirect()->route('banner.index')->with([
            'message' => 'Banner created successfully!',
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
        $data = Banner::findOrFail($id);
        return view('backend.banner.edit', compact('data'));
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
            Image::make($img)->resize(768, 450)->save('upload/banner/'.$filename);
            $filename_save = 'upload/banner/'.$filename;

            if(file_exists(Banner::findOrFail($id)->image))
            {
                unlink(Banner::findOrFail($id)->image);
            }

            Banner::where('id', $id)->update([
                'title' => $request->title,
                'url' => $request->url,
                'image' => $filename_save
            ]);

            return redirect()->route('banner.index')->with([
                'message' => 'Banner updated successfully!',
                'alert-type' => 'success'
            ]);
        }

        Banner::where('id', $id)->update([
            'title' => $request->title,
            'url' => $request->url,
        ]);

        return redirect()->route('banner.index')->with([
            'message' => 'Banner updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Banner::findOrFail($id);
        if(file_exists($data->image))
        {
            unlink($data->image);
        }
        $data->delete();
        return redirect()->route('banner.index')->with([
            'message' => 'Banner deleted successfully!',
            'alert-type' => 'success'
        ]);
    }
}
