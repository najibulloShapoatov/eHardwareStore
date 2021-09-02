<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_date',
        'order_sum',
        'payment_type',
        'order_status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function qntOrders()
    {
        return $this->where('order_status', 1)->count();
    }

    public function content(){
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    public function getUserRecentOrders($userID)
    {
        return $this->where('user_id', $userID)->orderBy('order_date', 'desc')->take(3)->get();
    }

    public function getMyOrders($userID)
    {
        return $this->where('user_id', $userID)->orderBy('order_date', 'desc')->paginate(15);
    }

    public function viewMyOrder($userID, $orderID)
    {
        return $this->where(['user_id' => $userID, 'id' => $orderID])->get()->first();
    }

}
