<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function signIn(Request $request)
    {

        $messages = [
            'phone.required' => 'Введите имя пользователя',
            'password.required' => 'Введите пароль'
        ];

        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        if ($user->checkUser($request)) {
            return redirect('/admin');
        } else {
            return redirect('/admin/login')->withErrors('Неправильное имя пользователя или пароль');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }

    public function profile()
    {
        return redirect('/admin/users/edit/' . Auth::user()->id);
    }

    public function index()
    {
        $user = new User();
        $users = $user->getList();
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = new User();
        $data = $user->getByID($id);
        return view('admin.users.show', compact('data'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Введите имя',
            'phone.required' => 'Введите номер телефона',
            'phone.unique' => 'Номер телефон занять. Выберите другой.',
            'password.required' => 'Введите пароль',
            'password.confirmed' => 'Пароли не совпадают',
            'password.min' => 'Пароль должен быть не менее 6 символов'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/users/create')
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $user = new User();
            $result = $user->createUser($request);

            if($result)
            {
                return redirect('/admin/users')->with('success_message','Успешно добавлен.');
            }
        }

    }

    public function edit($id)
    {
        $user = new User();
        $data = $user->getByID($id);
        return view('admin.users.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $user = new User();
        $data = $user->getByID($id);

        $messages = [
            'name.required' => 'Введите имя',
            'phone.required' => 'Введите номер телефона',
            'phone.unique' => 'Номер телефон занять. Выберите другой.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users,phone,' .$data->id,
        ], $messages);

        if(trim($request->password) != ''){
            $messages = [
                'password.required' => 'Введите пароль',
                'password.confirmed' => 'Пароли не совпадают',
                'password.min' => 'Пароль должен быть не менее 6 символов'
            ];

            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6'
            ], $messages);
        }

        // check validator
        if ($validator->fails()) {
            return redirect('admin/users/edit/' . $data->id)
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $result = $user->updateUser($request, $id);

            if($result){
                return redirect('/admin/users')->with('success_message','Сохранен.');
            }
        }

    }

    public function delete($id)
    {
        $user = new User();
        $result = $user->removeUser($id);
        if($result){
            return redirect('/admin/users')->with(['success_message' => 'Успешно удален.']);
        }
    }

    public function removeImage(Request $request){
        if( $request->ajax() ) {
            $user = new User();
            $result = $user->removeUserImage($request);
            if($result){
                return response()->json(['sts' => 1], 200);
            }
        }
    }

}
