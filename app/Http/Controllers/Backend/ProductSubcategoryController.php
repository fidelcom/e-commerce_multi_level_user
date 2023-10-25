<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategory = ProductSubcategory::latest()->get();
        return view('backend.product_subcategory.index', compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = ProductCategory::orderBy('name', 'ASC')->get();
        return view('backend.product_subcategory.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'product_category_id' => 'required'
        ]);

        ProductSubcategory::create([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
        ]);

        return redirect()->route('all.product.subcategory')->with([
            'message' => 'Product Category created successfully!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = ProductSubcategory::where('product_category_id', $id)->orderBy('name', 'ASC')->get();
        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory = ProductSubcategory::findOrFail($id);
        $category = ProductCategory::orderBy('name', 'ASC')->get();
        return view('backend.product_subcategory.edit', compact('subcategory', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'product_category_id' => 'required'
        ]);

        ProductSubcategory::where('id', $id)->update([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
        ]);

        return redirect()->route('all.product.subcategory')->with([
            'message' => 'Product Subcategory updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = ProductSubcategory::findOrFail($id);
        if(file_exists($subcategory->image))
        {
            unlink($subcategory->image);
        }
        $subcategory->delete();
        return redirect()->route('all.product.subcategory')->with([
            'message' => 'Product Subcategory deleted successfully!',
            'alert-type' => 'success'
        ]);
    }
}
