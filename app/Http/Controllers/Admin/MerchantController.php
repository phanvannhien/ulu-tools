<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;

use Str;

class MerchantController extends Controller
{

    public function index(){
        return view('admin.merchant.index', [ 'data' => Merchant::paginate() ]);
    }

    public function create(){
        return view('admin.merchant.create');
    }

    public function store(Request $request){
        $rules = [
            'email' => 'required|email|string|unique:merchants,email',
            'account' => 'required|string|unique:merchants,account',
            'password' => 'required|min:6|max:50',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $merchant = new Merchant();
        $merchant->email = $request->input('email');
        $merchant->password = Hash::make($request->input('password'));
        $merchant->account = $request->input('account');

        if( $request->input('account_id') != '' )
            $merchant->account_id = $request->input('account_id');
        else{
            $merchant->account_id = strtolower(Str::random(8)) ;
        }

        $merchant->terms = $request->input('terms');
        $merchant->agreement_term = 1;
        $merchant->company_name = $request->input('company_name');
        $merchant->company_tax_code = $request->input('company_tax_code');
        $merchant->company_phone = $request->input('company_phone');
        $merchant->company_address = $request->input('company_address');
        $merchant->company_website = $request->input('company_website');
        $merchant->status = $request->input('status');

        if( $request->hasFile('logo') ){
            $path = $request->file('logo')->store('logo');
            $merchant->logo = $path;
        }

        if( $merchant->save() ){
            return redirect()
                ->route( 'merchant.edit', $merchant->id )
                ->with('status',  'Success' );
        }
        return back()->with('status', 'Fail');
    }

    public function edit(Merchant $merchant){
        return view('admin.merchant.edit', compact('merchant') );
    }

    public function update(Request $request, Merchant $merchant){

        $rules = [];
        if( $merchant->email != $request->input('email') ){
            $rules['email'] = 'required|email|string|unique:merchants,email';

        }
        if( $merchant->account != $request->input('account') ){
            $rules['account'] = 'required|string|unique:merchants,account';
        }

        if( $request->has('has_change_password') ){
            $rules['password'] = 'required|min:6|max:50';
        }

        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        if( $request->has('has_change_password') )
            $merchant->password = Hash::make($request->input('password'));

        $merchant->email = $request->input('email');
        $merchant->account = $request->input('account');
        $merchant->terms = $request->input('terms');
        $merchant->agreement_term = 1;
        $merchant->company_name = $request->input('company_name');
        $merchant->company_tax_code = $request->input('company_tax_code');
        $merchant->company_phone = $request->input('company_phone');
        $merchant->company_address = $request->input('company_address');
        $merchant->company_website = $request->input('company_website');
        $merchant->status = $request->input('status');

        if( $request->hasFile('logo') ){
            $path = $request->file('logo')->store('logo');
            $merchant->logo = $path;
        }

        if( $merchant->save() ){
            return redirect()
                ->route( 'merchant.edit', $merchant->id )
                ->with('status',  'Success' );
        }
        return back()->with('status', 'Fail');
    }


    public function destroy(Merchant $merchant){
        $merchant->delete();

        return redirect()
            ->route( 'merchant.index' )
            ->with('status',  'Delete success' );

    }



}
