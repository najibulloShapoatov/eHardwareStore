<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'description',
        'date_publish',
        'point'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function getByProductID($id)
    {
        return $this->where('product_id', $id)->orderBy('date_publish','desc')->get();
    }

    public function addReview($input)
    {
        $productID = htmlspecialchars(trim($input['id']));
        $point = htmlspecialchars(trim($input['point']));
        $val = htmlspecialchars(trim($input['val']));

        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->product_id = $productID;
        $review->description = $val;
        $review->date_publish = date('Y-m-d');
        $review->point = $point;
        $result = $review->save();

        if($result){
            return $this->getByProductID($productID);
        }
    }
}
