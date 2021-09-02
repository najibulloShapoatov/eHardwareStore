<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BrandController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // list
    public function index()
    {
        $brand = new Brand();
        $brands = $brand->getList();
        return view('admin.brands.index', compact('brands'));
    }

    // add category form
    public function addBrandForm(Request $request)
    {
        if( $request->ajax() )
        {
            $html = View::make('admin.brands._add_form')->render();
            return response()->json(['html' => $html], 200);
        }
    }

    // insert category
    public function storeBrand(Request $request)
    {
        if( $request->ajax() ) {
            $data = new Brand();
            $result = $data->insertBrand($request);
            return response()->json($result, 200);
        }
    }

    // edit category
    public function editBrand(Request $request)
    {
        if( $request->ajax() ) {
            $input = $request->all();

            $id = htmlspecialchars(trim($input['id']));

            $brand = new Brand();
            $data = $brand->getByID($id);

            $html = View::make('admin.brands._edit_form', compact('data'))->render();
            return response()->json(['html' => $html], 200);
        }
    }

    // update
    public function updateBrand(Request $request)
    {
        if( $request->ajax() ) {
            $data = new Brand();
            $result = $data->updateBrand($request);
            return response()->json($result, 200);
        }
    }

}
