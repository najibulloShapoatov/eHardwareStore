<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Attribute extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'sort_order',
        'form_field',
        'front_form_field',
        'field_type'
    ];

    public function attrVals()
    {
        return $this->hasMany('App\Models\AttributeValue', 'attribute_id');
    }

    public function getByID($id)
    {
        return $this->where('id', $id)->get()->first();
    }

    public function getAll()
    {
        return $this->orderBy('sort_order', 'asc')->get();
    }

    public function getAttrsByCategoryID($categoryID)
    {
        return $this->where('category_id', $categoryID)->orderBy('sort_order', 'asc')->get();
    }

    public function store(Request $request)
    {
        $input = $request->all();

        // insert
        $attr = new Attribute();
        $attr->category_id = $input['category_id'];
        $attr->title = $input['title'];
        $attr->sort_order = $input['sort_order'];
        $attr->form_field = $input['form_field'];
        $attr->front_form_field = $input['front_form_field'];
        $attr->field_type = $input['field_type'];
        $result = $attr->save();

        if ($result) {
            return $attr;
        }
    }

    public function updateProp(Request $request)
    {
        $input = $request->all();

        $attr = $this->getByID($input['id']);

        $attr->category_id = $input['category_id'];
        $attr->title = $input['title'];
        $attr->sort_order = $input['sort_order'];
        $attr->form_field = $input['form_field'];
        $attr->front_form_field = $input['front_form_field'];
        $attr->field_type = $input['field_type'];
        $result = $attr->save();

        return [
            'sts' => $result,
            'data' => $this->getAttrsByCategoryID($input['category_id'])
        ];
    }

    public function deleteAttr(Request $request)
    {
        $input = $request->all();
        $attrID = $input['id'];

        // delete attr values
        DB::table('attribute_values')->where('attribute_id', $attrID)->delete();

        // delete attr
        DB::table('attributes')->where('id', $attrID)->delete();

        return true;
    }

    public function getProps($category_id, $product_id)
    {
        $helper = new FormFields();
        $list = $this->select('id','title','form_field')->where(['category_id' => $category_id])->orderBy('sort_order', 'asc')->get();

        $attrValues = new AttributeValue();
        $result = [];

        foreach ($list as $item)
        {
            $props = new ProductProperty();

            $result[] = $helper->renderField(
                $item->form_field,
                $item->id,
                $item->title,
                $attrValues->getAttrValuesByID($item->id),
                $props->getProdProps($product_id, $item->id)
            );

        }

        return $result;
    }

    public function getFrontProps($category_id, $product_id)
    {
        $helper = new FormFields();
        $list = $this->select('id','title','form_field')->where(['category_id' => $category_id])->orderBy('sort_order', 'asc')->get();

        $attrValues = new AttributeValue();
        $result = [];

        foreach ($list as $item)
        {
            $props = new ProductProperty();

            $result[] = $helper->renderFrontField(
                $item->form_field,
                $item->id,
                $item->title,
                $attrValues->getAttrValuesByID($item->id),
                $props->getProdProps($product_id, $item->id)
            );

        }

        return $result;
    }

    public function getViewFrontProps($category_id, $product_id)
    {
        $helper = new FormFields();
        $list = $this->select('id','title','form_field')->where(['category_id' => $category_id])->orderBy('sort_order', 'asc')->get();

        $attrValues = new AttributeValue();
        $result = [];

        foreach ($list as $item)
        {
            $props = new ProductProperty();

            $result[] = $helper->renderViewFrontField(
                $item->form_field,
                $item->id,
                $item->title,
                $attrValues->getAttrValuesByID($item->id),
                $props->getProdProps($product_id, $item->id)
            );

        }

        return $result;
    }


}
