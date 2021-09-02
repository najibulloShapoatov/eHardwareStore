<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Brand extends Model
{
    protected $fillable = [
        'date_add',
        'date_end',
        'title',
        'slug',
        'image',
        'is_active'
    ];

    public function getList()
    {
        return $this->orderBy('date_add', 'desc')->get();
    }

    public function getByID($id)
    {
        return $this->where('id', $id)->get()->first();
    }

    public function insertBrand(Request $request)
    {
        $input = $request->all();

        // upload image
        if($file = $request->file('image')){
            $image_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/brands/', $image_name);
            $input['image'] = $image_name;
        }

        $input['image'] = ($input['image'] != 'undefined') ? $input['image'] : '';

        // insert
        $result = $this->create($input);

        if($result){
            return ['sts' => 1];
        }

    }

    public function updateBrand(Request $request)
    {
        $input = $request->all();
        $brand = $this->getByID($input['id']);

        // upload image
        if($file = $request->file('image')){
            $image_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/brands/', $image_name);
            $input['image'] = $image_name;
        }

        if($input['image'] == 'undefined' || $input['image'] == ''){
            $input['image'] = $brand->image;
        }

        // update
        $result = $brand->update($input);

        if($result){
            return ['sts' => 1];
        }

    }




}
