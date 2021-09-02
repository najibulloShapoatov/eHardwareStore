<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'sms_code',
        'password',
        'user_type',
        'balance',
        'is_active',
        'date_reg',
        'date_auth',
        'image',
        'city',
        'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getByID($id)
    {
        return $this->where('id', $id)->get()->first();
    }

    public function checkUser(Request $request)
    {
        $input = $request->all();

        $phone = htmlspecialchars(trim($input['phone']));
        $password = htmlspecialchars(trim($input['password']));

        $remember = isset($input['remember']) ? $input['remember'] : 0;

        $result = $this->where(['phone' => $phone, 'user_type' => 7, 'is_active' => 1])->get()->first();

        if(!empty($result)){
            if(Hash::check($password, $result->password))
            {
                if($remember == 1){
                    Auth::loginUsingId($result->id, true);
                }
                else{
                    Auth::loginUsingId($result->id);
                }
                return true;

            }
            return false;
        }
        return false;
    }

    public function getList()
    {
        return $this->orderBy('created_at', 'desc')->paginate(15);
    }

    public function createUser(Request $request)
    {
        $input = $request->all();

        // password
        $input['password'] = bcrypt($request->password);

        // image
        if($file = $request->file('image')){
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/users', $name);
            $input['image'] = $name;
        }

        return $this->create($input);
    }

    public function updateUser(Request $request, $id)
    {
        $input = $request->all();

        $user = $this->getByID($id);

        // check for password
        if($input['password'] != ''){
            $input['password'] = bcrypt($request->password);
        }
        else{
            $input = $request->except('password');
        }

        // active
        if(empty($input['is_active'])){ $input['is_active'] = '0'; }

        // image
        if($file = $request->file('image')){
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/users', $name);
            $input['image'] = $name;
        }

        // update
        return $user->update($input);

    }

    public function removeUser($id)
    {
        $user = $this->getByID($id);
        if(file_exists('public/uploads/users/' . $user->image)) {
            if(!empty($user->image)) {
                unlink('public/uploads/users/' . $user->image);
            }
        }
        return $user->delete();
    }

    public function removeUserImage(Request $request)
    {
        $input = $request->all();
        $user = $this->getByID($input['id']);

        if(file_exists('public/uploads/users/' . $user->image)) {
            unlink('public/uploads/users/' . $user->image);
        }

        $input['image'] = '';
        return $user->update($input);
    }

    // existing login in db
    public function isLoginExists()
    {
        return $this->where('phone', $this->phone)->exists();
    }

    // validate sign up fields
    public function validateSignUpFields()
    {
        $patternPhoneCode = ['50','55','77','88','90','91','92','93','98','99','11','00'];
        $mobileregex = "/[0-9]{9}$/";
        $fl_array = preg_grep('/^'.substr($this->phone, 0, 2).'/', $patternPhoneCode);

        if(empty($this->name) || strlen($this->name) < 4){
            $error = ['error_code' => 1, 'msg' => 'Введите имя, содержащее больше 3 символов'];
            return $error;
        }
        if(empty($this->phone) || strlen($this->phone) != 9 || preg_match($mobileregex,$this->phone) === 0){
            $error = ['error_code' => 1, 'msg' => 'Введите номер телефона, пример: 900112233'];
            return $error;
        }
        if($this->isLoginExists()){
            $error = ['error_code' => 1, 'msg' => 'Ваш номер телефона имеется в нашей базе'];
            return $error;
        }
        if(count($fl_array) == 0){
            $error = ['error_code' => 1, 'msg' => 'Неправильный код мобильного оператора'];
            return $error;
        }
        if(empty($this->password) || strlen($this->password) < 6){
            $error = ['error_code' => 1, 'msg' => 'Выберите пароль, содержащий не менее 6 символов'];
            return $error;
        }
        if($this->password != $this->confirm_password){
            $error = ['error_code' => 1, 'msg' => 'Пароли не совпадают'];
            return $error;
        }
        return ['error_code' => 0, 'msg' => ''];
    }


    // validate checkout fields
    public function validateCheckoutFields($input)
    {
        $name = htmlspecialchars(trim($input['name']));
        $address = htmlspecialchars(trim($input['address']));
        $phone = htmlspecialchars(trim($input['phone']));
        $email = htmlspecialchars(trim($input['email']));

        if(empty($name) || strlen($name) < 4){
            $error = ['error_code' => 1, 'msg' => 'Введите имя, содержащее больше 3 символов'];
            return $error;
        }

        if(empty($address)){
            $error = ['error_code' => 1, 'msg' => 'Введите адрес'];
            return $error;
        }

        if(!Auth::check())
        {
            $patternPhoneCode = ['50','55','77','88','90','91','92','93','98','99','11','00'];
            $mobileregex = "/[0-9]{9}$/";
            $fl_array = preg_grep('/^'.substr($phone, 0, 2).'/', $patternPhoneCode);

            if(empty($phone) || strlen($phone) != 9 || preg_match($mobileregex,$phone) === 0){
                $error = ['error_code' => 1, 'msg' => 'Введите номер телефона, пример: 900112233'];
                return $error;
            }

            if(count($fl_array) == 0){
                $error = ['error_code' => 1, 'msg' => 'Неправильный код мобильного оператора'];
                return $error;
            }

            if($this->where('phone', $phone)->exists()){
                $error = ['error_code' => 1, 'msg' => 'Ваш номер телефона имеется в нашей базе. Выберите другой или <a href="/sign-in">авторизуйтесь</a>'];
                return $error;
            }

        }

        if(!empty($email)){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error = ['error_code' => 1, 'msg' => 'Введите правильны формат эл. почты'];
                return $error;
            }

        }

        return ['error_code' => 0, 'msg' => ''];
    }

    // create customer
    public function createCustomer()
    {
        $this->date_reg = date('Y-m-d H:i:s');
        $this->date_auth = date('Y-m-d H:i:s');
        $this->confirm_password = '';
        $this->password = Hash::make($this->password);
        return $this->save();
    }

    // get by phone nomber
    public function getByPhoneNo($no){
        return $this->where('phone', $no)->get()->first();
    }

    // validate sign-in fields
    public function validateSignInFields()
    {
        $patternPhoneCode = ['50','55','77','88','90','91','92','93','98','99','11'];
        $mobileregex = "/[0-9]{9}$/";
        $fl_array = preg_grep('/^'.substr($this->login, 0, 2).'/', $patternPhoneCode);

        if(empty($this->phone) || strlen($this->phone) != 9 || preg_match($mobileregex,$this->phone) === 0){
            $error = ['error_code' => 1, 'msg' => 'Введите номер телефона, пример: 900112233'];
            return $error;
        }
        if(count($fl_array) == 0){
            $error = ['error_code' => 1, 'msg' => 'Неправильный код мобильного оператора'];
            return $error;
        }
        if(empty($this->password)){
            $error = ['error_code' => 1, 'msg' => 'Введите пароль'];
            return $error;
        }
        return ['error_code' => 0, 'msg' => ''];
    }

    // check user for sign in (auth)
    public function checkCustomer(Request $request)
    {
        $input = $request->all();

        $result = $this->where(['phone' => $this->phone, 'is_active' => 1])->get()->first();
        if(!empty($result)){
            if(Hash::check($this->password, $result->password))
            {
                if($input['remember'] == 1){
                    Auth::loginUsingId($result->id, true);
                }
                else{
                    Auth::loginUsingId($result->id);
                }
                return true;
            }
            return false;
        }
        return false;
    }

    // automaticaly authorize user
    public function authAuto($userID)
    {
        return Auth::loginUsingId($userID);
    }

    // update user data
    public function updateUserData($input)
    {
        $name = htmlspecialchars(trim($input['name']));
        $lastname = htmlspecialchars(trim($input['lastname']));
        $address = htmlspecialchars(trim($input['address']));
        $city = htmlspecialchars(trim($input['city']));
        $email = htmlspecialchars(trim($input['email']));

        $user = $this->getByID(Auth::user()->id);
        $user->name = $name;
        $user->surname = $lastname;
        $user->email = $email;
        $user->city = $city;
        $user->address = $address;
        return $user->save();
    }

    // create unregistered user
    public function createUnregisteredUser($input)
    {
        $name = htmlspecialchars(trim($input['name']));
        $lastname = htmlspecialchars(trim($input['lastname']));
        $address = htmlspecialchars(trim($input['address']));
        $city = htmlspecialchars(trim($input['city']));
        $phone = htmlspecialchars(trim($input['phone']));
        $email = htmlspecialchars(trim($input['email']));
        $createAccount = htmlspecialchars(trim($input['createAccount']));

        $password = str_random(4);

        $user = new User();
        $user->name = $name;
        $user->surname = $lastname;
        $user->email = $email;
        $user->city = $city;
        $user->address = $address;
        $user->phone = $phone;
        $user->password = Hash::make($password);
        $user->unregistered = ($createAccount == 1) ? 0 : 1;
        $user->date_reg = date('Y-m-d H:i:s');
        $user->date_auth = ($createAccount == 1) ? date('Y-m-d H:i:s') : null;
        $result = $user->save();

        if($result){
            return [
                'id' => $user->id,
                'password' => $password,
                'create_account' => $createAccount
            ];
        }

    }

    public function changePassword($userID, $input)
    {
        $password = trim(htmlspecialchars($input['password']));
        $confirm_password = trim(htmlspecialchars($input['confirm_password']));

        if(!empty($password) && !empty($confirm_password))
        {
            if($password == $confirm_password)
            {
                $user = $this->where('id', $userID)->get()->first();
                $user->password = bcrypt($password);
                $user->save();
                $msg = ['error' => 0, 'errorMsg' => ''];
            }
            else
            {
                $msg = ['error' => 1, 'errorMsg' => 'Пароли не совпадают'];
            }
        }
        else{
            $msg = ['error' => 1, 'errorMsg' => 'Введите пароль'];
        }

        return $msg;
    }

    public function editProfile($userID, $request)
    {
        $input = $request->all();

        $name = trim(htmlspecialchars($input['name']));
        $surname = trim(htmlspecialchars($input['surname']));
        $phone = trim(htmlspecialchars($input['phone']));
        $email = trim(htmlspecialchars($input['email']));
        $city = trim(htmlspecialchars($input['city']));
        $address = trim(htmlspecialchars($input['address']));

        $msg = [];

        // validation
        // ...

        // user info
        $user = $this->where('id', $userID)->get()->first();
        $msg = ['image' => $user->image];

        // upload image
        if($file = $request->file('image')){
            $image_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/users/', $image_name);
            $user->image = $image_name;
            $msg = ['image' => $image_name];
        }

        // update
        $user->name = $name;
        $user->surname = $surname;
        $user->phone = $phone;
        $user->email = $email;
        $user->city = $city;
        $user->address = $address;
        $user->save();

        return $msg;
    }

}
