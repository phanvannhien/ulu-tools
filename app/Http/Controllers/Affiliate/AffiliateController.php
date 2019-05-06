<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;

use App\Http\Filters\AffiliateFilter;
use App\Models\Affiliate;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


use Validator;
use Auth;
use Hash;
use Session;
use GuzzleHttp\Client;


class AffiliateController extends Controller
{

    public function dashboard()
    {
        $campaigns = Campaign::where('status',1)->get();
        return view('affiliate.dashboard', compact('campaigns'));
    }

    public function profile(){
        $profile = auth()->user();
        return view('affiliate.user.profile', compact('profile') );
    }

    public function profileSave(Request $request )
    {

        $user = Auth::user();
        if($user->locked){
            return back()->with('warning', 'Để cập nhật thông tin bạn cần liên hệ Ban Quản Trị Công ty.');
        }

        $rules = [
            'full_name' => ['required', 'string', 'max:200']
        ];

        if( $user->phone != $request->input('phone') ){
            $rules['phone'] = ['required', 'string', 'min:10', 'max:11','unique:affiliates'];
        }

        $validator = Validator::make( $request->all() , $rules,[
            'full_name.required' => 'Vui lòng nhập họ tên',
            'full_name.string' => 'Vui lòng nhập họ tên dạng chữ',
            'full_name.max' => 'Vui lòng nhập họ tên tối đa 200 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email đúng định dạng',
            'email.max' => 'Vui lòng nhập email tối đa 200 ký tự',
            'email.unique' => 'Email này đã được sử dụng',
            'phone.required' => 'Vui lònh nhập số điện thoại',
            'phone.min' => 'Vui lòng nhập số điện thoại tối thiểu 10 số',
            'phone.max' => 'Vui lòng nhập số điện thoại tối đa 11 số',
            'phone.unique' => 'Số điện thoại đã được sử dụng'
        ]);


        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }
        $arrUpdate = [
            'full_name' => $request->input('full_name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'website' => $request->input('website'),
            'company' => $request->input('company'),

        ];


        if ($user->update($arrUpdate))
            return back()->with('status', 'Cập nhật thành công');

        return back()->with('status', 'Cập nhật lỗi');

    }

    public function changePassword(){
        return view('affiliate.user.change_password');
    }

    public function changePasswordSave( Request $request ){
        $user = Auth::user();
        $old_password = $request->input('old_pass');
        $rules['old_pass'] = 'required';

        if( !empty($old_password) ){
            $rules['password'] = 'required|min:6|max:100|confirmed';
        }
        $validator = Validator::make($request->all(), $rules,[
            'old_pass.required' => 'Vui lòng nhập mật khẩu cũ',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Vui lòng nhập mật khẩu ít nhất 6 kí tự',
            'password.max' => 'Vui lòng nhập mật khẩu tối đa 100 kí tự',
            'password.confirmed' => 'Nhắc lại mật khẩu không trùng khớp',
        ]);
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        if( !empty($old_password) ) {
            $new_password = $request->input('password');
            if (Hash::check($old_password, $user->getAuthPassword())) {
                $user->password = Hash::make($new_password);
            } else {
                return back()->with(['warning' => 'Mật khẩu cũ không đúng']);
            }
        }

        if($user->save()) {
            return back()->with(['status' => 'Cập nhật thành công']);
        }

        return back()->with(['status' => 'Cập nhật lỗi']);
    }

}
