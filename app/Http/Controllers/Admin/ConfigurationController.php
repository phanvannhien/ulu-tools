<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Configuration;
use Validator;

class ConfigurationController extends Controller
{
    public function index(){
        return view('admin.configurations.index', array('data' => Configuration::paginate()) );
    }


    public function store(Request $request){
        $arrConfigs = $request->input('config');
        foreach ($arrConfigs as $key => $value ) {
            $rules = [
                'config.'.$key => 'required'
            ];
        }


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }



        foreach ($arrConfigs as $key => $value) {
            # code...
            Configuration::where('name', $key)->update(
                array( 'value' => $value)
            );

        }

        return back()->with('status', 'Success' );
    }
}
