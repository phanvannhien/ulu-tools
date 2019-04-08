<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class ShopeeController extends Controller
{
    public function index()
    {

    }

    public function buildlink()
    {
        # code...
        return view('admin.shopee.buildlink');
    }

}
