<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    protected $fillable = [
        'category_id',
        'advice_type_id',
        'date_add',
        'date_end',
        'title',
        'slug',
        'preview_text',
        'articul',
        'description',
        'image',
        'is_active'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function type(){
        return $this->belongsTo('App\Models\AdviceType', 'advice_type_id');
    }

    public function getMainAdvices(){
        return $this->where('is_active', 1)->orderBy('date_add', 'desc')->take(6)->get();
    }

    public function getList(){
        return $this->where('is_active',1)->orderBy('date_add','desc')->paginate(10);
    }

    public function getDetail($slug){
        return $this->where(['is_active' => 1, 'slug' => $slug])->get()->first();
    }

    public function getOtherAdvices($slug){
        return $this->where('is_active', 1)->where('slug', '!=' , $slug)->orderBy('date_add', 'desc')->take(3)->get();
    }
}
