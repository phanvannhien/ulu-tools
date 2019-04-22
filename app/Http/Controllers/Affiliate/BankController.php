<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\Affiliate\UserBanks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;

class BankController extends Controller
{
    // Client banks
    public function index(){
        return view('affiliate.user.banks.index');
    }

    public function create(){

        return view('affiliate.user.banks.create');
    }

    public function store( Request $request){

        $rules = [
            'bank_name' => 'required|max:200',
            'bank_full_name' => 'required|max:120',
            'bank_acc_number' => 'required|numeric',
            'bank_location' => 'required|max:200',
        ];

        $messages = array(
            'bank_name.required' => 'Vui lòng nhập Tên ngân hàng',
            'bank_full_name.required' => 'Vui lòng nhập Tên tài khoản',
            'bank_full_name.max' => 'Vui lòng nhập Tên tài khoản tối đa 200 ký tự',
            'bank_acc_number.required' => 'Vui lòng nhập số tài khoản',
            'bank_acc_number.numeric' => 'Vui lòng nhập số tài khoản dạng số',
            'bank_location.required' => 'Vui lòng nhập chi nhánh ngân hàng',
            'bank_location.max' => 'Vui lòng nhập chi nhánh ngân hàng tối đa 200 ký tự',
        );


        $validator = Validator::make($request->all(), $rules, $messages );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $bank = new UserBanks();
        $bank->bank_name = $request->input('bank_name');
        $bank->bank_full_name = $request->input('bank_full_name');
        $bank->bank_acc_number = $request->input('bank_acc_number');
        $bank->bank_location = $request->input('bank_location');
        $bank->user_id = Auth::user()->id;

        if( UserBanks::count() <= 0 ){
            $bank->bank_default = 1;
        }

        if( $bank->save() ){
            return redirect()->route( 'bank.edit', $bank->id )->with('status','Thành công');
        }
        return back()->with('status','Có lỗi xảy ra');
    }

    public function edit( Request $request, $id ){

        $bank = UserBanks::findOrFail( $id );

        return view('affiliate.user.banks.edit', compact('bank'));
    }

    public function update(Request $request, $id){
        $rules = [
            'bank_name' => 'required|max:200',
            'bank_full_name' => 'required|max:120',
            'bank_acc_number' => 'required|numeric',
            'bank_location' => 'required|max:200',
        ];

        $messages = array(
            'bank_name.required' => 'Vui lòng nhập Tên ngân hàng',
            'bank_full_name.required' => 'Vui lòng nhập Tên tài khoản',
            'bank_full_name.max' => 'Vui lòng nhập Tên tài khoản tối đa 200 ký tự',
            'bank_acc_number.required' => 'Vui lòng nhập số tài khoản',
            'bank_acc_number.numeric' => 'Vui lòng nhập số tài khoản dạng số',
            'bank_location.required' => 'Vui lòng nhập chi nhánh ngân hàng',
            'bank_location.max' => 'Vui lòng nhập chi nhánh ngân hàng tối đa 200 ký tự',
        );

        $validator = Validator::make($request->all(), $rules, $messages );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $bank = UserBanks::findOrFail( $id );
        $bank->bank_name = $request->input('bank_name');
        $bank->bank_full_name = $request->input('bank_full_name');
        $bank->bank_acc_number = $request->input('bank_acc_number');
        $bank->bank_location = $request->input('bank_location');
        $bank->user_id = Auth::user()->id;

        if( UserBanks::count() <= 0 ){
            $bank->bank_default = 1;
        }

        if( $bank->save() ){
            return redirect()->route( 'bank.edit', $bank->id )->with('status','Thành công');
        }
        return back()->with('status','Có lỗi xảy ra');


    }

    public function destroy(Request $request, $id){

        $bank = UserBanks::findOrFail($id);
        
        if( $bank->bank_default ){
            return back()->with('status','Bạn không thể xoá ngân hàng mặc định');
        }

        $deleted = UserBanks::where('id', $id)->delete();

        if($deleted){
            return back()->with('status','Xoá thành công');
        }
        return back()->with('warning','Xoá lỗi');
    }

    public function setDefault($id)
    {
        # code...
        $bank = UserBanks::findOrFail($id);
        UserBanks::where('bank_default', '=', 1)->update(['bank_default' => 0]);
        $bank->bank_default = 1;
        $bank->save();
        return back()->with('status','Thành công');
    }

}
