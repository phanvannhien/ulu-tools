<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Affiliate\UserLevel;

use Validator;

class AffiliateLevelController extends Controller
{
    public function index(){
        $data = UserLevel::paginate();
        return view('admin.affiliate_level.index', compact('data'));
    }

    public function create(){
        return view('admin.affiliate_level.create');
    }

    public function store(Request $request){
        $rules = [
            'level_name' => 'required|string',
            'total_min' => 'required|integer',
            'total_max' => 'required|integer',
            'level_color' => 'required',
            'commision_rate' => 'required|integer',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        $data = new UserLevel();
        $data->level_name = $request->input('level_name');
        $data->total_min = $request->input('total_min');
        $data->total_max = $request->input('total_max');
        $data->level_color = $request->input('level_color');
        $data->commision_rate = $request->input('commision_rate');

        if( UserLevel::count() <= 0 ){
            $data->is_default = 1;
        }

        if( $data->save() ){
            return redirect()
                ->route( 'affiliate_level.edit', $data->id )
                ->with('status',  'Create success' );
        }
        return back()->with('status', 'Create fail');
    }

    public function edit($id){
        $data = UserLevel::findOrFail( $id );
        return view('admin.affiliate_level.edit', compact('data') );
    }

    public function update(Request $request, $id ){
        $rules = [
            'level_name' => 'required|string',
            'total_min' => 'required|integer',
            'total_max' => 'required|integer',
            'level_color' => 'required',
            'commision_rate' => 'required|integer',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $data = UserLevel::findOrFail( $id );
        $data->level_name = $request->input('level_name');
        $data->total_min = $request->input('total_min');
        $data->total_max = $request->input('total_max');
        $data->level_color = $request->input('level_color');
        $data->commision_rate = $request->input('commision_rate');

        if( $data->save() ){
            return redirect()
                ->route( 'affiliate_level.edit', $data->id )
                ->with('status',  'Update success' );
        }
        return back()->with('status', 'Update fail');
    }


    public function destroy(Merchant $merchant){
       
        return redirect()
            ->route( 'affiliate_level.index' )
            ->with('status',  'Delete success' );

    }

    public function setDefault($id){
        $data = UserLevel::findOrFail($id);
        UserLevel::where('is_default', '=', 1)->update(['is_default' => 0]);
        $data->is_default = 1;
        $data->save();
        return back()->with('status','Success');
    }

}
