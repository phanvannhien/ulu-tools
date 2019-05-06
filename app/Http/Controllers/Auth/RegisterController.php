<?php

namespace App\Http\Controllers\Auth;

use App\Models\Affiliate;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        return view('affiliate.auth.register');
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
            'full_name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:affiliates,username'],
            'password' => array(
                'required',
                'confirmed',
                'min:6',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ),
            'phone' => ['required', 'string', 'min:10', 'max:11','unique:affiliates'],
        ],[
            'full_name.required' => 'Vui lòng nhập họ tên',
            'full_name.string' => 'Vui lòng nhập họ tên dạng chữ',
            'full_name.max' => 'Vui lòng nhập họ tên tối đa 200 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email đúng định dạng',
            'email.max' => 'Vui lòng nhập email tối đa 200 ký tự',
            'email.unique' => 'Email này đã được sử dụng',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.min' => 'Vui lòng nhập số điện thoại tối thiểu 10 số',
            'phone.max' => 'Vui lòng nhập số điện thoại tối đa 11 số',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Vui lòng nhập mật khẩu tối thiểu 6 kí tự',
            'password.confirmed' => 'Nhắc lại mật khẩu không trùng khớp',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái (a-z, A-Z). Mật khẩu phải chứa ít nhất một ký tự đặc biệt !@#$%^&*|.',
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

        return Affiliate::create([
            'full_name' => $data['full_name'],
            'userid' => Str::lower( Str::random(8) ),
            'email' => $data['email'],
            'username' => $data['email'],
            'phone' => $data['phone'],
            'website' => $data['website'],
            'company' => $data['company'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->route('login');
    }
}
