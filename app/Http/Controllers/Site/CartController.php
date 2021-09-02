<?php

namespace App\Http\Controllers\Site;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    // view cart
    public function viewCart()
    {
        $cart = new Cart();

        if(Auth::user()){
            $data = $cart->getCart(Auth::user()->id);
        }
        else{
            $data = $cart->getCookieCart();
        }

        return view('site.cart.index', compact('data'));
    }

    // add to cart
    public function addToCart(Request $request)
    {
        if( $request->ajax() ) {
            $input = $request->all();
            $id = trim(htmlspecialchars($input['id']));
            $qnt = isset($input['qnt']) ? $input['qnt'] : 1;

            // product info
            $product = new Product();
            $productData = $product->getByID($id);

            if(Auth::user()){
                //----- add to cart table (db) -----

                // add to cart db
                $cart = new Cart();
                $addToCart = $cart->addToCart(Auth::user()->id, $productData->id, $productData->price, $qnt);  // set price with sale (%) ...

                if($addToCart){
                    return response()->json([
                        'id' => $productData->id
                    ], 200);
                }

            }
            else{
                //----- add to cookies -----

                $cart = Cookie::get('cart');
                $cartCount = Cookie::get('count');
                $cartPrice = Cookie::get('price');

                if(is_array($cartCount)){
                    if(array_key_exists($id, $cartCount)){
                        $cartQnt = $cartCount[$id] + $qnt;
                    }
                    else {
                        $cartQnt = $qnt;
                    }
                }
                else{
                    $cartQnt = $qnt;
                }

                return response()->json([
                    'id' => $productData->id
                ], 200)
                    ->withCookie(cookie("cart[".$id."]", $id))
                    ->withCookie(cookie("count[".$id."]", $cartQnt))
                    ->withCookie(cookie("price[".$id."]", $productData->price));
            }

        }
    }

    // get cart items
    public function getCartItems(Request $request){
        if( $request->ajax() ) {

            $cart = new Cart();
            if(Auth::user())
            {
                // get cart info
                $basket = $cart->getCart(Auth::user()->id);
            }
            else{
                // get cart from cookie
                $basket = $cart->getCookieCart();
            }

            $html = View::make('site.cart._items', compact('basket'))->render();
            return response()->json([
                'basket' => $basket,
                'html' => $html,
            ], 200);

        }
    }

    // remove product from cart
    public function removeFromCart(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $id = trim(htmlspecialchars($input['id']));

            $cart = new Cart();
            $result = $cart->removeFromCart($id);

            return response()->json($result, 200);
        }
    }

    // change qnt cart
    public function changeQuantityCart(Request $request)
    {
        if($request->ajax()) {
            $input = $request->all();

            $productID = htmlspecialchars(trim($input['id']));
            $qnt = (int)htmlspecialchars(trim($input['qnt']));

            $cart = new Cart();
            $data = $cart->changeQntCart($productID, $qnt);

            return response()->json($data, 200);

        }
    }

    // remove item from cart page
    public function removeFromCartPage(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $id = trim(htmlspecialchars($input['id']));

            $cart = new Cart();
            $result = $cart->removeFromCart($id);

            return response()->json($result, 200);
        }
    }

    // get cart total price
    public function getCartTotalPrice(Request $request)
    {
        if ($request->ajax()) {
            $cart = new Cart();
            if(Auth::user())
            {
                // get cart info
                $basket = $cart->getCart(Auth::user()->id);
            }
            else{
                // get cart from cookie
                $basket = $cart->getCookieCart();
            }

            return response()->json($basket, 200);
        }
    }

    // checkout
    public function checkout()
    {
        $cart = new Cart();

        $user = Auth::user();
        $userInfo = [];
        $createAccount = true;
        $phoneNo = false;

        if(Auth::check())
        {
            // get cart info
            $basket = $cart->getCart($user->id);

            $userInfo = [
                'name' => $user->name,
                'surname' => $user->surname,
                'phone' => $user->phone,
                'phone_readonly' => 'readonly',
                'email' => $user->email,
                'city' => $user->city,
                'address' => $user->address,
                'create_account' => true
            ];

            $createAccount = false;
            $phoneNo = true;

        }
        else{
            // get cart from cookie
            $basket = $cart->getCookieCart();
        }

        return view('site.cart.checkout', compact(['basket', 'userInfo', 'createAccount', 'phoneNo']));
    }

    // checkout order
    public function checkoutOrder(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            // validate
            $user = new User();
            $result = $user->validateCheckoutFields($input);

            // if it is not ok, then msg error
            if( $result['error_code'] != 0 ){
                return response()->json(['input' => $result], 200);
            }

            $cart = new Cart();
            $data = $cart->makeOrder($input);

            return response()->json(['input' => $data], 200);
        }
    }

    // add to wishlist
    public function addToWishlist(Request $request)
    {
        if( $request->ajax() ) {
            $input = $request->all();
            $id = trim(htmlspecialchars($input['id']));

            // product info
            $product = new Product();
            $productData = $product->getByID($id);

            // add to cookie
            return response()->json([
                'id' => $productData->id
            ], 200)
                ->withCookie(cookie("wishlist[".$id."]", $id));
        }
    }

    // count of wishlist
    public function qntWishlist(Request $request)
    {
        if( $request->ajax() )
        {
            $cart = new Cart();
            $wishlistQnt = $cart->getWishlistQnt();

            return response()->json($wishlistQnt, 200);
        }
    }

    // wishlist
    public function wishlist()
    {
        $cart = new Cart();
        $data = $cart->getWishlist();
        return view('site.cart.wishlist', compact('data'));
    }

    // remove from wishlist
    public function removeFromWishlist(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $id = trim(htmlspecialchars($input['id']));

            $cart = new Cart();
            $result = $cart->removeFromWishlist($id);

            return response()->json($result, 200);
        }
    }


}
