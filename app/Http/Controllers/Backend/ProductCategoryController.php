<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = ProductCategory::latest()->get();
        return view('backend.product_category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $img = $request->file('image');
//            unlink(public_path('upload/admin/profile/'.Auth::user()->photo));
        $filename = Str::uuid().'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(300, 300)->save('upload/product_category/'.$filename);
        $filename_save = 'upload/product_category/'.$filename;

        ProductCategory::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'image' => $filename_save
        ]);

        return redirect()->route('all.product.category')->with([
            'message' => 'Product Category created successfully!',
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
        $category = ProductCategory::findOrFail($id);
        return view('backend.product_category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if ($request->file('image')){
            $img = $request->file('image');
            $filename = Str::uuid().'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300, 300)->save('upload/product_category/'.$filename);
            $filename_save = 'upload/product_category/'.$filename;

            if(file_exists(ProductCategory::findOrFail($id)->image))
            {
                unlink(ProductCategory::findOrFail($id)->image);
            }

            ProductCategory::where('id', $id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-', $request->name)),
                'image' => $filename_save
            ]);

            return redirect()->route('all.product.category')->with([
                'message' => 'Product Category updated successfully!',
                'alert-type' => 'success'
            ]);
        }

        ProductCategory::where('id', $id)->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
        ]);

        return redirect()->route('all.product.category')->with([
            'message' => 'Product Category updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ProductCategory::findOrFail($id);
        if(file_exists($category->image))
        {
            unlink($category->image);
        }
        $category->delete();
        return redirect()->route('all.product.category')->with([
            'message' => 'Product Category deleted successfully!',
            'alert-type' => 'success'
        ]);
    }
}
