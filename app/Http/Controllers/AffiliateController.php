<?php

namespace App\Http\Controllers;

use App\Http\Filters\AffiliateFilter;
use App\Models\Affiliate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Pap_Api_Affiliate;
use Gpf_Rpc_Array;
use Pap_Api_AffiliatesGrid;

use Validator;

class AffiliateController extends Controller
{

    public function index( Request $request, AffiliateFilter $filter ){
        $data = Affiliate::filter( $filter )->paginate();

        return view('admin.affiliate.index', [ 'data' => $data ]);
    }

    public function create(){
        return back();
    }

    public function store(Request $request){
        return back();
    }

    public function edit(Affiliate $affiliate){
        return view('admin.affiliate.edit', compact('affiliate') );
    }

    public function update(Request $request, Affiliate $affiliate){
        $rules = [
            'commission_rate' => 'required|integer',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        $affiliate->commission_rate = $request->input('commission_rate');


        if( $affiliate->save() ){
            return redirect()
                ->route( 'affiliate.edit', $affiliate->id )
                ->with('status',  'Update success' );
        }
        return back()->with('status', 'Update fail');
    }


    public function destroy(Merchant $merchant){
        return back();
    }


    public function syncPAP(){

        $request = new Pap_Api_AffiliatesGrid( Session::get('admin') );
        //$request->addFilter('username', Gpf_Data_Filter::EQUALS, 'affiliate@example.com');

        // sets limit to 30 rows, offset to 0 (first row starts)
        $request->setLimit(0, 30);

        // sets columns, use it only if you want retrieve other as default columns
        $request->addParam('columns', new Gpf_Rpc_Array(array(
            array('id'),
            array('refid'),
            array('userid'),
            array('username'),
            array('firstname'),
            array('lastname'),
            array('rstatus'),
            array('parentuserid'),
            array('dateinserted'),
            array('data8'),


        )));

        // send request
        try {
            $request->sendNow();
        } catch(Exception $e) {
            return back()->with('status', "API call error: ".$e->getMessage());
        }
        // request was successful, get the grid result
        $grid = $request->getGrid();
        // get recordset from the grid
        $recordset = $grid->getRecordset();

        //----------------------------------------------
        // in case there are more than 30 records in total,
        // we should load and display the rest of the records
        // via the cycle below

        $totalRecords = $grid->getTotalCount();
        $maxRecords = $recordset->getSize();

        if ($maxRecords != 0) {
            $cycles = ceil($totalRecords / $maxRecords);


            for( $i=0; $i < $cycles; $i++) {

                // now get next 30 records
                $request->setLimit($i * $maxRecords, $maxRecords);
                $request->sendNow();
                $recordset = $request->getGrid()->getRecordset();

                // iterate through the records
                foreach($recordset as $rec) {
                    Affiliate::updateOrCreate(
                        ['id' => $rec->get('id')],
                        [
                            'id' => $rec->get('id'),
                            'refid' => $rec->get('refid'),
                            'userid' => $rec->get('userid'),
                            'username' => $rec->get('username'),
                            'firstname' => $rec->get('firstname'),
                            'lastname' => $rec->get('lastname'),
                            'rstatus' => $rec->get('rstatus'),
                            'parentuserid' => $rec->get('parentuserid'),
                            'dateinserted' => $rec->get('dateinserted'),
                            'data8' => $rec->get('data8'),
                            'commission_rate' => 70
                        ]);

                }
            }
        }

        return back()->with('status', 'Success');

    }

}
