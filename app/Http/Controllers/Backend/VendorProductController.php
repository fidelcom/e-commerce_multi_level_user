<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class VendorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::where('user_id', Auth::user()->id)->latest()->get();
        return view('vendor.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = ProductCategory::latest()->get();
        $brand = Brand::latest()->get();
        $subcategory = ProductSubcategory::latest()->get();
        $vendor = User::where([
            'role' => 'vendor',
            'status' => 'active'
        ])->latest()->get();

        return view('vendor.product.create', compact('category', 'brand', 'subcategory', 'vendor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $image = $request->file('thumbnail');
        $img_name = hexdec(uniqid()).''.$request->file('thumbnail')->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/'.$img_name);
        $filename = 'upload/products/thumbnail/'.$img_name;

        $product = Product::create([
            'brand_id' => $request->brand_id,
            'product_category_id' => $request->	product_category_id ,
            'product_subcategory_id' => $request->	product_subcategory_id ,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'code' => $request->code,
            'quantity' => $request->quantity,
            'tags' => $request->tags,
            'size' => $request->size,
            'color' => $request->color,
            'price' => $request->price,
            'discount' => $request->discount,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'thumbnail' => $filename,
            'user_id' => !empty($request->user_id) ? $request->user_id : Auth::user()->id,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
        ]);

//        multiple image upload
        $images = $request->file('multi_image');
        foreach ($images as $img)
        {
            $image_name = hexdec(uniqid()).''.$img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('upload/products/multi_image/'.$image_name);
            $file_name = 'upload/products/multi_image/'.$image_name;

            MultiImage::create([
                'product_id' => $product->id,
                'name' => $file_name
            ]);
        }

        return redirect()->route('vendor.all.product')->with([
            'message' => 'Product added successfully!',
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
        $category = ProductCategory::latest()->get();
        $brand = Brand::latest()->get();
        $subcategory = ProductSubcategory::latest()->get();
        $vendor = User::where([
            'role' => 'vendor',
            'status' => 'active'
        ])->latest()->get();
        $product = Product::findOrFail($id);
        return view('vendor.product.edit', compact('category', 'brand', 'subcategory', 'vendor', 'product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Product::findOrFail($id)->update([
            'brand_id' => $request->brand_id,
            'product_category_id' => $request->	product_category_id ,
            'product_subcategory_id' => $request->	product_subcategory_id ,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'code' => $request->code,
            'quantity' => $request->quantity,
            'tags' => $request->tags,
            'size' => $request->size,
            'color' => $request->color,
            'price' => $request->price,
            'discount' => $request->discount,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'user_id' => !empty($request->user_id) ? $request->user_id : Auth::user()->id,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
        ]);

        return redirect()->route('vendor.all.product')->with([
            'message' => 'Product updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function updateThumbnail(Request $request, string $id)
    {
        $prod = Product::findOrFail($id);
        $image = $request->file('thumbnail');
        $img_name = hexdec(uniqid()).''.$request->file('thumbnail')->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/'.$img_name);
        $filename = 'upload/products/thumbnail/'.$img_name;
        if (file_exists($prod->thumbnail))
        {
            unlink($prod->thumbnail);
        }

        $prod->update([
            'thumbnail' => $filename,
        ]);

        return redirect()->route('vendor.all.product')->with([
            'message' => 'Product image updated successfully!',
            'alert-type' => 'success'
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prod = Product::findOrFail($id);
        unlink($prod->thumbnail);
        foreach ($prod->multiImage as $img)
        {
            unlink($img->name);
        }

        $prod->delete();
        return redirect()->back()->with([
            'message' => 'Product deleted successfully!',
            'alert-type' => 'success'
        ]);
    }
}
