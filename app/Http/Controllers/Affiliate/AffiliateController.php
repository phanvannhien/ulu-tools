<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;

use App\Http\Filters\AffiliateFilter;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Pap_Api_Affiliate;
use Gpf_Rpc_Array;
use Pap_Api_AffiliatesGrid;
use Gpf_Rpc_FormRequest;

use App\APIs\PAP;

use Validator;
use Auth;
use GuzzleHttp\Client;


class AffiliateController extends Controller
{

    public function dashboard()
    {

        $sessionId = session()->get('affiliate')->getSessionId();
        $queryTrendsReport = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Reports_TrendsReportWidget",+"M":"load",+"isInitRequest":"Y",+"filterType":"trends_report",+"filters":[["rstatus","IN","A"],["datetime","DP","L30D"]]},{"C":"Pap_Stats_TransactionTypes",+"M":"getActionTypes",+"filters":[["rstatus","IN","A"],["datetime","DP","L30D"]]}],+"S":"'.$sessionId.'"}';

        $client = new Client();
        $response =  $client->request('POST', 'https://account.ulu.vn/scripts/server.php', [
            'body' => $queryTrendsReport,
            'headers' => [
                "Access-Control-Allow-Credentials"=> true,
                "Access-Control-Allow-Origin" => "*",
                "content-type" => "application/x-www-form-urlencoded"
            ]
        ]);

        $data = $response->getBody()->getContents();

   

        $data = json_decode($data);

        $queryTrendsReportAction = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Reports_TrendsReportActionWidget",+"M":"load",+"filters":[["action","E","S"],["rstatus","IN","A"],["datetime","DP","L30D"]]}],+"S":"'.$sessionId.'"}';
        $response =  $client->request('POST', 'https://account.ulu.vn/scripts/server.php', [
            'body' => $queryTrendsReportAction,
            'headers' => [
                "Access-Control-Allow-Credentials"=> true,
                "Access-Control-Allow-Origin" => "*",
                "content-type" => "application/x-www-form-urlencoded"
            ]
        ]);

        $dataReportAction = $response->getBody()->getContents();
        $dataReportAction = json_decode($dataReportAction);

       

        $queryChart = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Reports_TrendsReport",+"M":"loadData",+"isInitRequest":"N",+"filterType":"trends_report",+"filters":[["datetime","DP","L30D"],["rpc","=","Y"],["groupBy","=","day"],["dataType1","=","saleCount"],["dataType2","=","_item_none_"],["rstatus","IN","A"]]}],+"S":"'.$sessionId.'"}';
        $response =  $client->request('POST', 'https://account.ulu.vn/scripts/server.php', [
            'body' => $queryChart,
            'headers' => [
                "Access-Control-Allow-Credentials"=> true,
                "Access-Control-Allow-Origin" => "*",
                "content-type" => "application/x-www-form-urlencoded"
            ]
        ]);

        $dataChart = $response->getBody()->getContents();
        $dataChart = json_decode($dataChart);

        return view('affiliate.dashboard', compact('data','dataReportAction','dataChart'));
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

        $user->update($arrUpdate);
        if ($user)
            return back()->with('status', 'Cập nhật thành công');
        return back()->with('status', 'Cập nhật lỗi');


        if( $user->save() ){
            return back()>with('status',  'Cập nhật thành công' );
        }
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
