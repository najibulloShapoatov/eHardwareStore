<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // list
    public function index()
    {
        $category = new Category();
        $categories = $category->getList();
        return view('admin.categories.index', compact('categories'));
    }

    // get category
    public function getCategory($id)
    {
        // category
        $category = new Category();
        $data = $category->getCategory($id);

        /*echo "<pre>";
        print_r($data);
        echo "</pre>";*/

        // products
        $productsList = [];
        if(!empty($data['child'])){
            $products = new Product();
            $productsList = $products->getListByCategoryID($data['child']['id']);
        }

        return view('admin.categories.category', compact(['data','productsList']));
    }

    // add category form
    public function addCategoryForm(Request $request)
    {
        if( $request->ajax() )
        {
            $input = $request->all();
            $id = htmlspecialchars(trim($input['id']));

            $category = new Category();
            $categories = $category->getList();

            $html = View::make('admin.categories._add_form', compact(['categories','id']))->render();
            return response()->json(['html' => $html], 200);
        }
    }

    // insert category
    public function storeCategory(Request $request)
    {
        if( $request->ajax() ) {
            $data = new Category();
            $result = $data->store($request);
            return response()->json($result, 200);
        }
    }

    // edit category
    public function editCategory(Request $request)
    {
        if( $request->ajax() ) {
            $input = $request->all();
            $id = htmlspecialchars(trim($input['id']));
            $parent_id = htmlspecialchars(trim($input['parent_id']));

            $category = new Category();
            $categories = $category->getList();
            $data = $category->getByID($id);

            $html = View::make('admin.categories._edit_form', compact(['data','categories','parent_id']))->render();
            return response()->json(['html' => $html], 200);
        }
    }

    // update
    public function updateCategory(Request $request)
    {
        if( $request->ajax() ) {
            $data = new Category();
            $result = $data->updateCategory($request);
            return response()->json($result, 200);
        }
    }

}
