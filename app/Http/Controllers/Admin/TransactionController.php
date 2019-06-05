<?php
namespace App\Http\Controllers\Admin;
use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;

use App\Http\Filters\TransactionFilter;
use App\Imports\TransactionImport;
use App\Models\Affiliate;
use App\Models\Campaign;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\ServicesUlu\AdminUlu;
use Excel;
use Str;
use Illuminate\Support\Arr;

class TransactionController extends Controller
{
    public function index(Request $request, TransactionFilter $filter, AdminUlu $ulu){

        $perPage = 100;

        if( $request->has('action') && $request->get('action') == 'download' ){
            $perPage = 5000;
        }



        $page = $request->page ? $request->page : 1;
        $offset = ( $page-1 ) * $perPage;

        if( $request->has('created_at') ){
            $arrDate = explode( '-', $request->get('created_at') );
            //dd(trim($arrDate[0]));
            $startDate = str_replace('/','-',trim($arrDate[0]));
            $endDate = str_replace('/','-',trim($arrDate[1]));

            $queryDate = $startDate.','.$endDate;
        }

        $params = [
            'page' => $page,
            'per_page' => $perPage,
            'order_id' => $request->has('order_id') ? $request->input('order_id') : '',
            'campaign_id' => $request->has('campaign_id') ? $request->input('campaign_id') : '',
            'affiliate_id' => $request->has('affiliate_id') ? $request->input('affiliate_id') : '',
            'status' => $request->has('status') ? $request->input('status') : '',
            'created_at' => isset($queryDate) ? $queryDate : ''
        ];


        $conversions = $ulu->getConversions( $params );


        $dataChart = [];


        foreach ( $conversions->payloads->summary as $item ){

            $month = ($item->_id->month < 10) ? '0'.$item->_id->month : $item->_id->month;
            $day = ($item->_id->day < 10) ? '0'.$item->_id->day : $item->_id->day;

            array_push($dataChart, [
                'date' => $item->_id->year.'-'.$month.'-'.$day,
                'total_revenue' => $item->totalAmount,
                'total_order' => $item->count
            ]);


        }

        $dataChart = array_values( Arr::sort($dataChart, function ($value) {
            return $value['date'];
        }));



        $data = new Paginator(
            $conversions->payloads->data,
            $conversions->payloads->total_records,
            $perPage,
            $page, ['path'  => $request->url(), 'query' => $request->query()]);


        $dataCampaigns = Campaign::select('campaigns.campaign_id', 'campaign_name')
            ->get()->toArray();

        $campaigns = array();
        foreach ($dataCampaigns as $campaign){
            $campaigns[$campaign['campaign_id']] = $campaign['campaign_name'];
        }

        $dataAff = Affiliate::select('userid', 'full_name')->orderBy('full_name')
            ->get()->toArray();

        $affiliates = array();
        foreach ($dataAff as $aff){
            $affiliates[$aff['userid']] = $aff['full_name'];
        }


        if( $request->has('action') && $request->get('action') == 'download' ){
            return Excel::download( new TransactionExport(  $conversions->payloads->data, $campaigns, $affiliates ),
                'conversion'. now() .'.xlsx' );
        }

        return view('admin.transactions.index',  compact('data',
            'conversions',
            'campaigns',
            'affiliates',
            'dataChart'
        ));
    }

    public function import(Request $request){
        return view('admin.transactions.import');
    }
    public function importSave(Request $request){

        if( $request->hasFile('file') ){
            try {
                Excel::import(new TransactionImport(), request()->file('file'));
                return back()->with('status', 'Import success' );
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();

                foreach ($failures as $failure) {
                    $failure->row(); // row that went wrong
                    $failure->attribute(); // either heading key (if using heading row concern) or column index
                    $failure->errors(); // Actual error messages from Laravel validator
                }
                return back()->withErrors( $failures );
            }
        }

        return back()->with('warning','Select file');

    }
}
