<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class AttributeController extends Controller
{
    public function getProps($id)
    {
        // category
        $category = new Category();
        $data = $category->getCategory($id);

        // props
        $attributes = new Attribute();
        $props = $attributes->getAttrsByCategoryID($id);

        return view('admin.attributes.index', compact(['data', 'props']));
    }

    public function addPropertyForm(Request $request)
    {
        if( $request->ajax() )
        {
            $input = $request->all();
            $id = htmlspecialchars(trim($input['id']));
            $html = View::make('admin.attributes._add_form', compact('id'))->render();
            return response()->json(['html' => $html], 200);
        }
    }

    public function addProperty(Request $request)
    {
        if( $request->ajax() )
        {
            $prop = new Attribute();
            $data = $prop->store($request);
            $html = View::make('admin.attributes._add_table_row', compact('data'))->render();
            return response()->json(['sts' => 1, 'html' => $html], 200);
        }
    }

    public function editPropertyForm(Request $request)
    {
        if( $request->ajax() )
        {
            $input = $request->all();
            $id = htmlspecialchars(trim($input['id']));
            $attributes = new Attribute();
            $data = $attributes->getByID($id);
            $html = View::make('admin.attributes._edit_form', compact('data'))->render();
            return response()->json(['html' => $html], 200);
        }
    }

    public function updateProperty(Request $request)
    {
        if( $request->ajax() )
        {
            $prop = new Attribute();
            $result = $prop->updateProp($request);

            if($result['sts']){
                $data = $result['data'];
                $html = View::make('admin.attributes._table_rows', compact('data'))->render();
                return response()->json(['sts' => 1, 'html' => $html], 200);
            }

        }
    }

    public function propertyValues(Request $request)
    {
        if( $request->ajax() )
        {
            $input = $request->all();
            $id = htmlspecialchars(trim($input['id']));

            // attribute info
            $attributes = new Attribute();
            $data = $attributes->getByID($id);

            $html = View::make('admin.attributes._attr_val_form', compact('data'))->render();
            return response()->json(['html' => $html, 'info' => $data], 200);
        }
    }

    public function propertyValuesSave(Request $request)
    {
        if( $request->ajax() )
        {
            $input = $request->all();

            $attrVal = new AttributeValue();
            $data = $attrVal->saveAttrValues($input);

            return response()->json($data, 200);
        }
    }

    public function deleteProperty(Request $request)
    {
        if( $request->ajax() )
        {
            $prop = new Attribute();
            $prop->deleteAttr($request);
            return response()->json(['sts' => 1], 200);
        }
    }

}
