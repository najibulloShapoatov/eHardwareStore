<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdviceType extends Model
{
    protected $fillable = [
        'sort_order',
        'title',
        'slug'
    ];

    public function advices(){
        return $this->hasMany('App\Models\Advice', 'advice_type_id');
    }

    public function getList()
    {
        return $this->get();
    }

    public function getByType($slug)
    {
        return $this->where('slug', $slug)->get()->first();
    }
}
