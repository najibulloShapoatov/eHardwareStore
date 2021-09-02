<?php

namespace App\Providers;


use App\Models\Cart;
use App\Models\Category;
use App\Models\Configuration;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //NEW: Increase StringLength

        // client side
        View::composer('*', function ($view) {

            // user info
            $userInfo = [];

            // cart
            $cart = new Cart();
            if(Auth::user()){
                // user info
                $user = new User();
                $userInfo = $user->getByID(Auth::user()->id);
                $cartItems = $cart->getCart(Auth::user()->id);
            }
            else{
                $cartItems = $cart->getCookieCart();
            }

            // catalog
            $category = new Category();
            $categories = $category->getList();

            // config
            $config = new Configuration();
            $dataConfig = $config->getConfig();

            // wishlist qnt
            $wishlistQnt = $cart->getWishlistQnt();

            $view->with([
                'categories' => $categories,
                'userInfo' => $userInfo,
                'basket' => $cartItems,
                'dataConfig' => $dataConfig,
                'wishlistQnt' => $wishlistQnt
            ]);
        });

        // admin side
        View::composer('layouts/admin', function ($view) {

            // user info
            $user = new User();
            $userInfo = $user->getByID(Auth::user()->id);

            // catalog
            $category = new Category();
            $categories = $category->getList();

            // orders
            $order = new Order();
            $ordersCount = $order->qntOrders();

            $view->with([
                'userInfo' => $userInfo,
                'categories' => $categories,
                'ordersCount' => $ordersCount
            ]);

        });

    }
}
