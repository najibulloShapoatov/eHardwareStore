<?php

namespace App\Http\Controllers\Site;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function getRandomImages()
    {
        $array = [];
        for ($i = 1; $i <= 20; $i++) {
            $array[] = $i . ".jpg";
        }

        $k = array_rand($array);
        $v = $array[$k];

        return $v;
    }

    // get sms-code
    private function smsCode(){
        $pool = '0123456789';
        return substr(str_shuffle(str_repeat($pool, 4)), 0, 4);
    }

    // sugn-up page
    public function signUpPage()
    {
        $image = $this->getRandomImages();

        if(Auth::user()){
            return redirect('/');
        }

        return view('site.account.sign-up', compact('image'));
    }

    // sign up process
    public function signUp(Request $request)
    {
        if ($request->ajax())
        {
            $input = $request->all();
            $smsCode = $this->smsCode();

            $user = new User();
            $user->name = htmlspecialchars(trim($input['name']));
            $user->phone = htmlspecialchars(trim($input['phone']));
            $user->password = htmlspecialchars(trim($input['password']));
            $user->confirm_password = htmlspecialchars(trim($input['confirm_password']));
            $user->sms_code = $smsCode;

            // validate
            $result = $user->validateSignUpFields();

            // if it is not ok, then msg error
            if( $result['error_code'] != 0 ){
                return response()->json(['input' => $result], 200);
            }

            // create customer (save)
            $data = $user->createCustomer();

            // if created, then login customer
            if($data){

                // automaticaly authorize user
                $user->authAuto($user->id);

                // get user info by phone no.
                $userData = $user->getByPhoneNo($user->phone);

                if($userData)
                {
                    // if isset cookie, add to cart
                    $cCart = Cookie::get('cart');
                    $cCartCount = Cookie::get('count');
                    $cCartPrice = Cookie::get('price');

                    if(!empty($cCart))
                    {
                        foreach ($cCart as $key => $value)
                        {
                            // add to cart
                            $cart = new Cart();
                            $cart->addToCart($userData->id, $key, $cCartPrice[$key], $cCartCount[$key]);  // set price with sale (%) in future ...

                            // remove cookie item product
                            Cookie::queue(Cookie::forget('cart['.$key.']'));
                            Cookie::queue(Cookie::forget('count['.$key.']'));
                            Cookie::queue(Cookie::forget('price['.$key.']'));
                        }
                    }
                }

                // msg success
                return response()->json([
                    'input' => [
                        'error_code' => 0,
                        'msg' => 'Успешно! <br>Выполняется вход ...'
                    ]
                ], 200);
            }
            else{
                // msg error auth
                return response()->json([
                    'input' => [
                        'error_code' => 1,
                        'msg' => 'Ошибка авторизации'
                    ]
                ], 200);
            }

        }
    }

    // sugn-in page
    public function signInPage()
    {
        $image = $this->getRandomImages();

        if(Auth::user()){
            return redirect('/');
        }

        return view('site.account.sign-in', compact('image'));
    }

    // sign in
    public function signIn(Request $request)
    {
        if ($request->ajax())
        {
            $input = $request->all();

            $user = new User();
            $user->phone = htmlspecialchars(trim($input['phone']));
            $user->password = htmlspecialchars(trim($input['password']));

            // validate
            $result = $user->validateSignInFields();

            // if it is not ok, then msg error
            if( $result['error_code'] != 0 ){
                return response()->json(['input' => $result], 200);
            }

            if($user->checkCustomer($request))
            {
                // if isset cookie, add to cart
                $cCart = Cookie::get('cart');
                $cCartCount = Cookie::get('count');
                $cCartPrice = Cookie::get('price');

                if(!empty($cCart))
                {
                    foreach ($cCart as $key => $value)
                    {
                        // add to cart
                        $cart = new Cart();
                        $cart->addToCart(Auth::user()->id, $key, $cCartPrice[$key], $cCartCount[$key]);  // set price with sale (%) in future ...

                        // remove cookie item product
                        Cookie::queue(Cookie::forget('cart['.$key.']'));
                        Cookie::queue(Cookie::forget('count['.$key.']'));
                        Cookie::queue(Cookie::forget('price['.$key.']'));
                    }
                }

                return response()->json([
                    'input' => [
                        'error_code' => 0,
                        'msg' => 'Успешно! <br>Выполняется вход ...'
                    ]
                ], 200);
            }

            return response()->json([
                'input' => [
                    'error_code' => 1,
                    'msg' => 'Не верный номер телефона или пароль'
                ]
            ], 200);

        }
    }

    // dashboard
    public function dashboard()
    {
        if(Auth::check())
        {
            // user recent orders (limit 3)
            $order = new Order();
            $recentOrders = $order->getUserRecentOrders(Auth::user()->id);
            return view('site.account.index', compact('recentOrders'));
        }
        return redirect('/');
    }

    // profile
    public function profile()
    {
        if(Auth::check())
        {
            return view('site.account.profile');
        }
        return redirect('/');
    }

    // profile update
    public function profileUpdate(Request $request)
    {
        if(Auth::check())
        {
            if ($request->ajax()) {
                $input = $request->all();
                $data = new User();
                $result = $data->editProfile(Auth::user()->id, $request);
                return response()->json($result, 200);
            }
        }
        return redirect('/');
    }

    // my orders
    public function myOrders()
    {
        if(Auth::check())
        {
            // my orders
            $order = new Order();
            $myOrders = $order->getMyOrders(Auth::user()->id);
            return view('site.account.orders', compact('myOrders'));
        }
        return redirect('/');
    }

    // view my order
    public function viewMyOrder($orderID)
    {
        if(Auth::check())
        {
            $order = new Order();
            $orderData = $order->viewMyOrder(Auth::user()->id, $orderID);

            return view('site.account.order_view', compact(['orderData']));
        }
        return redirect('/');
    }

    // change password
    public function password()
    {
        if(Auth::check())
        {
            return view('site.account.password');
        }
        return redirect('/');
    }

    // change password
    public function passwordChange(Request $request)
    {
        if(Auth::check())
        {
            if ($request->ajax()) {
                $input = $request->all();
                $data = new User();
                $result = $data->changePassword(Auth::user()->id, $input);
                return response()->json($result, 200);
            }
        }
        return redirect('/');
    }

}
