<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Validator;
use Session;

use Pap_Api_Session;

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
            'email' => 'required|email|string',
            'password' => 'required|string',
            'account' => 'required|string',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        $merchant = new Merchant();
        $merchant->email = $request->input('email');
        $merchant->password = $request->input('password');
        $merchant->account = $request->input('account');

        if( $merchant->save() ){
            return redirect()
                ->route( 'merchant.edit', $merchant->id )
                ->with('status',  'Create success' );
        }
        return back()->with('status', 'Create fail');
    }

    public function edit(Merchant $merchant){
        return view('admin.merchant.edit', compact('merchant') );
    }

    public function update(Request $request, Merchant $merchant){
        $rules = [
            'email' => 'required|email|string',
            'password' => 'required|string',
            'account' => 'required|string',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        $merchant->email = $request->input('email');
        $merchant->password = $request->input('password');
        $merchant->account = $request->input('account');

        if( $merchant->save() ){
            return redirect()
                ->route( 'merchant.edit', $merchant->id )
                ->with('status',  'Update success' );
        }
        return back()->with('status', 'Update fail');
    }


    public function destroy(Merchant $merchant){
        $merchant->delete();

        return redirect()
            ->route( 'merchant.index' )
            ->with('status',  'Delete success' );

    }


    public function login( Request $request ){

    }



}
