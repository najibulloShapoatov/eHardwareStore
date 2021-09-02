<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'title'
    ];

    public function getList()
    {
        return $this->orderBy('title', 'asc')->get();
    }
}
