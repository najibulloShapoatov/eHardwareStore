<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\Manufacture;
use App\Models\Product;
use App\Models\ProductImage;
use function GuzzleHttp\Psr7\_parse_request_uri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function add($catID)
    {
        $product = new Product();
        $prodID = $product->add($catID);
        return redirect('/admin/products/edit/' . $prodID);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $product = new Product();
        $data = $product->getByID($id);

        $category = new Category();
        $categories = $category->getList();
        $cat = $category->getCategory($data->category_id);

        $brand = new Brand();
        $brands = $brand->getList();

        $country = new Country();
        $countries = $country->getList();

        // attributes
        $prop = new Attribute();
        $details = $prop->getProps($data->category_id, $data->id);

        $manufactures = [];

        return view('admin.products.edit', compact([
            'data',
            'cat',
            'categories',
            'brands',
            'manufactures',
            'countries',
            'details'
        ]));
    }

    public function update(Request $request, $id)
    {
        $product = new Product();
        $data = $product->getByID($id);

        $messages = [
            'category_id.required' => 'Выберите категорию',
            'title.required' => 'Введите заголовок товара',
            'slug.required' => 'Введите алиас товара',
            'slug.unique' => 'Алиас занят. Выберите другой',
            'articul.required' => 'Введите артикул товара',
            'price.required' => 'Введите стоимость товара',
            'description.required' => 'Введите описание товара'
        ];

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:products,slug,'.$data->id,
            'articul' => 'required',
            'price' => 'required',
            'description' => 'required'
        ], $messages);

        // check validator
        if ($validator->fails()) {
            return redirect('/admin/products/edit/' . $data->id)
                ->withErrors($validator)
                ->withInput();
        }
        else{

            //print_r($request->all());

            $catID = $product->updateProduct($request, $id);
            if($catID){
                return redirect('/admin/categories/' . $catID)->with('success_message','Сохранен.');
            }
        }
    }

    // remove products image
    public function deleteimg(Request $request){
        if( $request->ajax() ) {
            $input = $request->all();
            $msg = ProductImage::deleteImage($input['id']);
            return response()->json(array('msg'=> $msg), 200);
        }
    }

    // gallery (upload)
    public function uploadImageGallery(Request $request){
        if( $request->ajax() ) {
            $gallery = ProductImage::addToGallery($request);
            return response()->json($gallery, 200);
        }
    }

    // gallery remove image
    public function removeImageGallery(Request $request){
        if( $request->ajax() ) {
            $input = $request->all();
            $msg = ProductImage::deleteImageGallery($input['id']);
            return response()->json(array('sts' => $msg), 200);
        }
    }


}
