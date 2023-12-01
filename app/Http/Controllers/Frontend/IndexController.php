<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function productDetails($id, $slug)
    {
        $product = Product::findOrFail($id);
        $related_product = Product::where([
            'product_category_id' => $product->product_category_id
        ])->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(5)->get();
        return view('frontend.product.product_details', compact('product', 'related_product'));
    }

    public function vendorDetails($id)
    {
        $vendor = User::findOrFail($id);
        $vproduct = Product::where('user_id', $id)->get();
        return view('frontend.vendor.vendor_details',compact('vendor', 'vproduct'));
    }

    public function vendorList()
    {
        $vendors = User::where(['role' => 'vendor', 'status' => 'active'])->orderBy('name', 'ASC')->get();
        return view('frontend.vendor.vendor_list', compact('vendors'));
    }

    public function catWise(Request $request,$id, $slug)
    {
        $products = Product::where(['status' => 1, 'product_category_id' => $id])->orderBy('id', 'DESC')->get();
        $categories = ProductCategory::orderBy('name', 'ASC')->get();
        $breadCat = ProductCategory::findOrFail($id);
        $newProducts = Product::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
        return view('frontend.product.category_view', compact('products', 'categories', 'breadCat', 'newProducts'));
    }

    public function shop()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(20);
        $categories = ProductCategory::orderBy('name', 'ASC')->get();
        $newProducts = Product::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
        return view('frontend.product.shop', compact('products', 'categories',  'newProducts'));
    }

    public function subcatWise(Request $request,$id, $slug)
    {
        $products = Product::where(['status' => 1, 'product_subcategory_id' => $id])->orderBy('id', 'DESC')->get();
        $categories = ProductCategory::orderBy('name', 'ASC')->get();
        $breadSubcat = ProductSubcategory::findOrFail($id);
        $newProducts = Product::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
        return view('frontend.product.subcategory_view', compact('products', 'categories', 'breadSubcat', 'newProducts'));
    }
}
