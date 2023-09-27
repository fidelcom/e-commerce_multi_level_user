<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
            ]);

            $img = $request->file('brand_image');
//            unlink(public_path('upload/admin/profile/'.Auth::user()->photo));
            $filename = Str::uuid().'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300, 300)->save('upload/brand/'.$filename);
            $filename_save = 'upload/brand/'.$filename;

            Brand::create([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
                'brand_image' => $filename_save
            ]);

            return redirect()->route('all.brand')->with([
                'message' => 'Brand created successfully!',
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
        $brand = Brand::findOrFail($id);
        return view('backend.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if ($request->file('brand_image')){
            $img = $request->file('brand_image');
            $filename = Str::uuid().'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300, 300)->save('upload/brand/'.$filename);
            $filename_save = 'upload/brand/'.$filename;

            if(file_exists(Brand::findOrFail($id)->brand_image))
            {
                unlink(Brand::findOrFail($id)->brand_image);
            }

            Brand::where('id', $id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
                'brand_image' => $filename_save
            ]);

            return redirect()->route('all.brand')->with([
                'message' => 'Brand updated successfully!',
                'alert-type' => 'success'
            ]);
        }

        Brand::where('id', $id)->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
        ]);

        return redirect()->route('all.brand')->with([
            'message' => 'Brand updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        if(file_exists($brand->brand_image))
        {
            unlink($brand->brand_image);
        }
        $brand->delete();
        return redirect()->route('all.brand')->with([
            'message' => 'Brand deleted successfully!',
            'alert-type' => 'success'
        ]);
    }
}
