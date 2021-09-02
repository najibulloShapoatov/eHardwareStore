<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        if(Auth::user()){
            return view('admin.index');
        }
        else{
            return redirect('/admin/login');
        }
    }

    // login
    public function login()
    {
        return view('admin.login');
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
