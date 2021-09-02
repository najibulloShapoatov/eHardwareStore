<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'email'
    ];

    public function subscribe($email)
    {
        if(!empty($email) || $email != ''){
            if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false){
                // valid email
                $res = $this->where('email', $email)->get()->first();
                if(!empty($res)){
                    // exists
                    return "<span class='subsErr'>Вы уже подписаны на нашу рассылку.</span>";
                }
                else{
                    // add email
                    $subs = new Subscription();
                    $subs->email = $email;
                    $subs->save();
                    return "<span class='subsSuc'>Вы успешно подписались на нашу рассылку.</span>";
                }
            }
            else{
                // error email
                return "<span class='subsErr'>Введите правильную эл. почту.</span>";
            }
        }
        else{
            // empty email
            return "<span class='subsErr'>Введите эл. почту.</span>";
        }
    }
}
