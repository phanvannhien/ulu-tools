<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Imports\ShopeeDataFeedImport;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ShopeeController extends Controller
{
    public function index()
    {

    }

    public function buildlink()
    {
        return view('admin.shopee.buildlink');
    }

    public function smartLink()
    {
        return view('admin.shopee.smart_link');
    }


}
