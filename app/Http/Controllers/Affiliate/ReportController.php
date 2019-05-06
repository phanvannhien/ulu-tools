<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\Mongo\ClickTracking;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Session;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Filters\TransactionFilter;

use Excel;
use Str;

use App\Exports\TransactionExport;

class ReportController extends Controller
{
    public function report(Request $request, TransactionFilter $filter){


        $data = Sale::filter($filter)->where('userid', auth()->user()->refid )
            ->orderBy('conversion_date', 'DESC');

        $total = $data->sum('totalcost');
        $commission_total = $data->sum('commission');

        if( $request->input('action') == 'download' ){
            return Excel::download( new TransactionExport(  $data->get() ), 'conversion'. str_replace('/','-', $request->get('conversion_date') ).'.xlsx' );
        }

        $data = $data->paginate(100);
        return view('affiliate.reports.commission', compact('data', 'total','commission_total'));


    }


    public function reportClick(Request $request){

        return view('affiliate.reports.click', compact('data'));
    }


}
