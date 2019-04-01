<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Pap_Api_TransactionsGrid;
use Gpf_Data_Filter;
use Gpf_Rpc_Array;

class TransactionController extends Controller
{
    public function index(Request $request){

        $req = new Pap_Api_TransactionsGrid($request->merchant);

        // list here all columns which you want to read from grid
        $req->addParam('columns', new Gpf_Rpc_Array(array(
            array('id'),
            array('transid'),
            array('campaignid'),
            array('orderid'),
            array('commission'),
            array('status'),
            array('rtype'),
            array('userid'),
            array('rstatus')
        )));
        //$req->addFilter('orderid', Gpf_Data_Filter::EQUALS, 'ORD_12345XYZ');
        $req->setLimit(0, 100);
        $req->setSorting('orderid', false);
        $req->sendNow();
        $grid = $req->getGrid();
        $recordset = $grid->getRecordset();

        return view('admin.transactions.index', compact('recordset'));
    }

    public function check(Request $request){








    }
}
