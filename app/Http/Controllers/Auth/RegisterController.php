<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required','string','max:12'],
            'mail' => ['required','string','email','unique:users','max:12'],
            'password' => ['required','string','min:4','max:12'],
        ],[
            'required' => 'この項目は必須です。',
            'email' => 'メールアドレスを正しく入力してください。',
            'max' => '12文字以下でお願いします。',
            'min' => '4文字以上でお願いします。'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        //入力フォームに入力した値に対してValidationの判定を行う
        if($request->isMethod('post')){
            $data = $request->input();
            $val = $this->validator($data); //validation実行
            //val引っかかったら
            if($val->fails()){
                return redirect('/register')
                    ->withErrors($val)
                    ->withInput();
            }else{
                $this->create($data);
                return redirect('added');
            }

        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
