<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function addForm(Product $product)
    {
        return view('admin.image.add', [
            'product' => $product
        ]);
    }

    public function postAdd(Product $product, Request $request)
    {
        $image_p = new Image();
        $image_p->product_id = $product->id;
        if ($request->image) {
            $image = $request->image;
            $imageName = $image->hashName();
            $image_p->image = $image->storeAs('images/products', $imageName);
        } else {
            $image_p->image = '';
        }
        $image_p->save();
        return redirect()->route('admin.product.image', $product->id);
    }

    public function delete(Image $image)
    {
        $image->delete();
        return redirect()->back();
    }

    public function list()
    {
        $images = Image::select('images.*')->get();
        return view('admin.image.list', [
            'images' => $images
        ]);
    }

    public function updateForm(Image $img)
    {
        return view('admin.image.update', [
            'img' => $img
        ]);
    }

    public function putUpdate(Image $img, Request $request)
    {
        if ($request->image) {
            $image = $request->image;
            $imageName = $image->hashName();
            $img->image = $image->storeAs('images/products', $imageName);
        } else {
            $img->image = $img->image;
        }
        $img->save();
        return redirect()->route('admin.product.image', $img->product_id);
    }
}
