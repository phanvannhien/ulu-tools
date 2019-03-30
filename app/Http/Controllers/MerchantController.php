<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{

    public function index(){
        return view('admin.merchant.index', [ 'data' => Merchant::paginate() ]);


    }

}
