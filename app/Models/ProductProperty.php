<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{

    protected $fillable = [
        'product_id',
        'attribute_id',
        'attribute_value',
        'number_value'
    ];

    public function getProdProps($product_id, $attribute_id){
        return $this->select('attribute_value')->where(['product_id'=> $product_id, 'attribute_id' => $attribute_id])->get()->toArray();
    }

    public function updateProdProps($id, $attrs){

        // delete
        $this->where('product_id',$id)->delete();

        // add attr values
        foreach ($attrs as $key => $value)
        {
            if(is_array($value)){
                // multiple
                foreach ($value as $item)
                {
                    $prodProp = new ProductProperty();
                    $prodProp->product_id = $id;
                    $prodProp->attribute_id = $key;
                    $prodProp->attribute_value = $item;
                    $prodProp->number_value = 1;
                    $prodProp->save();
                }
            }
            else
            {
                if(!empty($value))
                {
                    // simple
                    $prodProp = new ProductProperty();
                    $prodProp->product_id = $id;
                    $prodProp->attribute_id = $key;
                    $prodProp->attribute_value = $value;
                    $prodProp->number_value = 1;
                    $prodProp->save();
                }
            }
        }

    }

}
