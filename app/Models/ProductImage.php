<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductImage extends Model
{

    // upload product's image
    public static function uploadProductImage(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if($file = $request->file('image'))
        {
            if (!is_dir('public/uploads/products/' .  $product->id)) {
                mkdir('public/uploads/products/' .  $product->id, 0777, true);
            }
            else{
                if($product->image != ''){
                    if(file_exists(public_path() . '/uploads/products/' . $product->id . '/' . $product->image)) {
                        unlink(public_path() . '/uploads/products/' . $product->id . '/' . $product->image);
                        unlink(public_path() . '/uploads/products/' . $product->id . '/thumb_' . $product->image);
                    }
                }
            }

            $path = public_path() . '/uploads/products/' .  $product->id . '/';
            $image = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $img = Image::make($image);
            $img->save($path . $imageName);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path . 'thumb_' . $imageName);
            return $imageName;
        }
        else{
            return $product->image;
        }
    }

    public static function deleteImage($id)
    {
        $product = Product::findOrFail($id);
        if($product->image != ''){
            if(file_exists('public/uploads/products/' . $product->id . '/' . $product->image)) {
                unlink('public/uploads/products/' . $product->id . '/' . $product->image);
                unlink('public/uploads/products/' . $product->id . '/thumb_' . $product->image);
            }
            $product->image = '';
            $product->save();
            return "ok";
        }
    }

    public static function addToGallery(Request $request)
    {
        if($file = $request->file('file')) {

            $input = $request->all();
            $productID = $input['id'];

            if (!is_dir('public/uploads/products/' . $productID)) {
                mkdir('public/uploads/products/' . $productID, 0777, true);
            }

            $path = public_path() . '/uploads/products/' . $productID . '/';
            $image = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;

            $img = Image::make($image);
            $img->save($path . $imageName);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path . 'thumb_' . $imageName);

            $gallery = new ProductGallery();
            $gallery->product_id = $productID;
            $gallery->image = $imageName;
            $gallery->save();

            return ['id' => $gallery->id, 'img' => $imageName];
        }
    }

    public static function deleteImageGallery($id)
    {
        $gallery = ProductGallery::findOrFail($id);
        if($gallery->image != ''){
            if(file_exists('public/uploads/products/' . $gallery->product_id . '/' . $gallery->image)) {
                unlink('public/uploads/products/' . $gallery->product_id . '/' . $gallery->image);
                unlink('public/uploads/products/' . $gallery->product_id . '/thumb_' . $gallery->image);
            }
        }
        $gallery->delete();
        return "ok";
    }


}
