<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = [
        'about_company_sitebar',
        'office_manager_phone',
        'address',
        'phone',
        'email',
        'working_days',
        'facebook_link',
        'telegram_link',
        'instagram_link',
        'whatsapp_link',
        'viber_link'
    ];

    public function getConfig()
    {
        return $this->where('id',1)->get()->first();
    }
}
