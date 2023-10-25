<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductStatuController extends Controller
{
    public function status($id)
    {
        $prod = Product::findOrFail($id);
        $prod->update([
            'status' => $prod->status == 1 ? 0 : 1,
        ]);

        return redirect()->back()->with([
            'message' => 'Product status updated successfully!',
            'alert-type' => 'success'
        ]);
    }
}
