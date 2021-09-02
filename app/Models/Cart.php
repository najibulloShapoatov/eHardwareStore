<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price'
    ];

    public function addToCart($userID, $productID, $productPrice, $qnt){
        $cart = $this->where([ 'user_id' => $userID, 'product_id' => $productID ])->get()->first();

        if(!empty($cart)){
            $cart->quantity = $cart->quantity + $qnt;
        }
        else{
            $cart = new Cart();
            $cart->user_id = $userID;
            $cart->product_id = $productID;
            $cart->quantity = 1;
            $cart->price = $productPrice;
        }
        return $cart->save();
    }

    public function getCart($userID){
        $data = $this->where('user_id', $userID)->get();

        $qnt = 0;
        $sum = 0;
        $result = [];
        if(count($data) > 0){
            foreach ($data as $item) {
                $qnt = $qnt + $item->quantity;
                $sum = $sum + ($item->price*$item->quantity);
                $result['items'][$item->product_id] = Product::where('id', $item->product_id)->get()->first();
                $result['items'][$item->product_id]['cart_qnt'] = $item->quantity;
                $result['items'][$item->product_id]['cart_price'] = $item->price;
            }
        }
        $result['qnt'] = $qnt;
        $result['sum'] = $sum;

        return $result;
    }

    public function getCookieCart(){
        $cart = Cookie::get('cart');
        $cartCount = Cookie::get('count');
        $cartPrice = Cookie::get('price');

        $qnt = 0;
        $sum = 0;
        $result = [];
        if(!empty($cart)){
            foreach ($cart as $item){
                $qnt = $qnt + $cartCount[$item];
                $sum = $sum + ($cartPrice[$item]*$cartCount[$item]);
                $result['items'][$item] = Product::where('id', $item)->get()->first();
                $result['items'][$item]['cart_qnt'] = $cartCount[$item];
                $result['items'][$item]['cart_price'] = $cartPrice[$item];
            }
        }
        $result['qnt'] = $qnt;
        $result['sum'] = $sum;

        return $result;
    }

    public function removeFromCart($id)
    {
        if(Auth::user()) {
            // from user's cart
            $userID = Auth::user()->id;
            $cartItem = Cart::where(['user_id' => $userID, 'product_id' => $id])->get()->first();
            if($cartItem){
                return $cartItem->delete();
            }
        }
        else{
            // from cookie
            $cart = Cookie::get('cart');
            $cartCount = Cookie::get('count');
            $cartPrice = Cookie::get('price');

            // remove id from cart array
            unset($cart[$id]);
            unset($cartCount[$id]);
            unset($cartPrice[$id]);

            Cookie::queue(Cookie::forget('cart['.$id.']'));
            Cookie::queue(Cookie::forget('count['.$id.']'));
            Cookie::queue(Cookie::forget('price['.$id.']'));

            return true;
        }
    }

    public function updateCookieCartItem($id, $q)
    {
        $cart = Cookie::get('cart');
        $cartCount = Cookie::get('count');
        $cartPrice = Cookie::get('price');

        Cookie::queue("count[".$id."]", $q, 3600);

        $qnt = 0;
        $sum = 0;
        $result = [];
        if(!empty($cart)){
            foreach ($cart as $item){
                if($item == $id){
                    $qnt = $qnt +  $q;
                    $sum = $sum + ($cartPrice[$item]*$q);
                }
                else{
                    $qnt = $qnt + $cartCount[$item];
                    $sum = $sum + ($cartPrice[$item]*$cartCount[$item]);
                }
            }
        }
        $result['qnt'] = $qnt;
        $result['sum'] = $sum;

        return $result;
    }

    public function changeQntCart($productID, $qnt)
    {
        if (Auth::user())
        {
            // auth
            $userID = Auth::user()->id;

            // change qnt cart in db
            $prod = $this->where('product_id', $productID)->get()->first();
            if($prod){
                $prod->quantity = (int)$qnt;
                $prod->save();
            }

            // get cart info
            return [
                'cart' => $this->getCart($userID),
                'itogo' => number_format((float)( $prod->price * $prod->quantity ), 2, '.', ''),
                'is_auth' => true
            ];
        }
        else
        {
            // cookie
            $cartPrice = Cookie::get('price');

            // update count item of cookie
            $cart = $this->updateCookieCartItem($productID, $qnt);

            // get cart info
            return [
                'cart' => $cart,
                'itogo' => number_format((float)( $cartPrice[$productID] * $qnt ), 2, '.', ''),
                'is_auth' => false
            ];

        }
    }

    // update/create user (order ordering)
    public function makeOrder($input)
    {
        if (Auth::user())
        {
            // update user
            $user = new User();
            $data = $user->updateUserData($input);

            if($data){

                // cart items
                $cartItems = $this->where('user_id', Auth::user()->id)->get();

                if(count($cartItems) > 0) {

                    // save to orders
                    $order = new Order();
                    $order->user_id = Auth::user()->id;
                    $order->order_date = date('Y-m-d H:i:s');
                    $order->order_sum = 0.00;
                    $order->payment_type = 1;
                    $order->save();

                    //save order items
                    $sum = 0.00;
                    foreach ($cartItems as $item){
                        $orderItems = new OrderItem();
                        $orderItems->order_id = $order->id;
                        $orderItems->product_id = $item->product_id;
                        $orderItems->quantity = $item->quantity;
                        $orderItems->price = $item->price;
                        $orderItems->save();

                        $orderItems = null;
                        $sum = $sum + ($item->quantity*$item->price);
                    }

                    $order->order_sum = $sum;
                    $order->save();

                    // remove items from cart
                    DB::table('carts')->where('user_id', Auth::user()->id)->delete();

                    return [
                        'error_code' => 0,
                        'msg' => 'Спасибо! Ваш заказ оформлен. Наш менеджер с Вами свяжется в кратчайшие сроки.'
                    ];
                }
            }
        }
        else{
            // save user db
            $user = new User();
            $data = $user->createUnregisteredUser($input);

            // from cookie
            $cart = Cookie::get('cart');
            $cartCount = Cookie::get('count');
            $cartPrice = Cookie::get('price');

            $cartItems = $this->getCookieCart();

            if(count($cartItems['items']) > 0)
            {
                // save to orders
                $order = new Order();
                $order->user_id = $data['id'];
                $order->order_date = date('Y-m-d H:i:s');
                $order->order_sum = $cartItems['sum'];
                $order->payment_type = 1;
                $order->save();

                //save order items
                foreach ($cartItems['items'] as $key => $element){
                    $orderItems = new OrderItem();
                    $orderItems->order_id = $order->id;
                    $orderItems->product_id = $key;
                    $orderItems->quantity = $element['cart_qnt'];
                    $orderItems->price = $element['cart_price'];
                    $orderItems->save();

                    // remove items from cart (cookie)
                    unset($cart[$key]);
                    unset($cartCount[$key]);
                    unset($cartPrice[$key]);

                    Cookie::queue(Cookie::forget('cart['.$key.']'));
                    Cookie::queue(Cookie::forget('count['.$key.']'));
                    Cookie::queue(Cookie::forget('price['.$key.']'));
                }

                $text = '';
                if($data['create_account'] == 1){
                    // login new user
                    $user->authAuto($data['id']);

                    // sand password to user
                    $text = '<br><br>Ваш пароль: <strong>' . $data['password'] . '</strong><br>Используйте его при входе в систему.<br><br><a href="/">Вернутся на главную страницу</a>';
                }

                return [
                    'error_code' => 0,
                    'msg' => 'Спасибо! Ваш заказ оформлен. Наш менеджер с Вами свяжется в кратчайшие сроки.' . $text
                ];

            }

        }

    }

    public static function getStatus($productID)
    {
        $wishlist = Cookie::get('wishlist');

        if(is_array($wishlist)){
            if(array_key_exists($productID, $wishlist)){
                return 1;
            }
            return 0;
        }
        return 0;
    }

    public function getWishlistQnt()
    {
        $wishlist = Cookie::get('wishlist');
        $qnt =  0;
        if(is_array($wishlist)){
            $qnt = count($wishlist);
        }

        return $qnt;
    }

    public function getWishlist()
    {
        $wishlist = Cookie::get('wishlist');
        $data = [];
        if(!empty($wishlist))
        {
            $ids = array_values($wishlist);

            $product = new Product();
            $data = $product->getListByIds($ids);
        }
        return $data;
    }

    public function removeFromWishlist($id)
    {
        // from cookie
        $wishlist = Cookie::get('wishlist');

        // remove id from cart array
        unset($wishlist[$id]);
        Cookie::queue(Cookie::forget('wishlist['.$id.']'));

        return true;
    }

}
