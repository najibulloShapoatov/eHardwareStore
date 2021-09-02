<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    protected $fillable = [
        'date_add',
        'date_end',
        'sort_order',
        'title',
        'slug',
        'image',
        'is_active'
    ];

    public function getList()
    {
        return $this->orderBy('date_add', 'desc')->get();
    }
}
