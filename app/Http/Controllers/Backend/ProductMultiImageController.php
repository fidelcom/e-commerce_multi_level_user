<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductMultiImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $product_id)
    {
        $images = $request->file('multi_image');
        foreach ($images as $img)
        {
            $image_name = hexdec(uniqid()).''.$img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('upload/products/multi_image/'.$image_name);
            $file_name = 'upload/products/multi_image/'.$image_name;

            MultiImage::create([
                'product_id' => $product_id,
                'name' => $file_name
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Product multi image added successfully!',
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product_id)
    {
        if ($request->multi_image){
            foreach ($request->multi_image as $id => $img)
            {
                $prod = MultiImage::findOrFail($id);
//            dd($prod);
                $img_name = hexdec(uniqid()).''.$img->getClientOriginalExtension();
                Image::make($img)->resize(800, 800)->save('upload/products/multi_image/'.$img_name);
                $filename = 'upload/products/multi_image/'.$img_name;
                if (file_exists($prod->name))
                {
                    unlink($prod->name);
                }

                $prod->update([
                    'name' => $filename,
                ]);
            }
            return redirect()->back()->with([
                'message' => 'Product image updated successfully!',
                'alert-type' => 'success'
            ]);
        } else{
            return redirect()->back()->with([
                'message' => 'Please select an image you want to use to replace the current image',
                'alert-type' => 'error'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $img = MultiImage::findOrFail($id);
        if (file_exists($img->name))
        {
            unlink($img->name);
        }
        $img->delete();
        return redirect()->back()->with([
            'message' => 'Product image deleted successfully!',
            'alert-type' => 'success'
        ]);
    }
}
