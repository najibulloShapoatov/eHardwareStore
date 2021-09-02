<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttributeValue extends Model
{
    protected $fillable = [
        'attribute_id',
        'attribute_value'
    ];

    public function saveAttrValues($input)
    {
        $id = htmlspecialchars(trim($input['id']));

        // delete
        DB::table('attribute_values')->where('attribute_id', $id)->delete();

        // save
        $data = explode(',', $input['v']);
        foreach($data as $item){
            if(!empty($item)){
                $attrV = new AttributeValue();
                $attrV->attribute_id = $id;
                $attrV->attribute_value = $item;
                $attrV->save();
            }
        }

        return true;
    }

    public function getAttrValuesByID($attr_id){
        return $this->select('id','attribute_value')->where('attribute_id', $attr_id)->get()->toArray();
    }

}
