<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Pap_Api_Session;
use Pap_Api_Transaction;
use Pap_Api_TransactionsGrid;
use Gpf_Rpc_Array;
use Gpf_Data_Filter;

class HomeController extends Controller
{
    public function index(){
        return view('admin.index');
        // login (as merchant)
        $session = new Pap_Api_Session("https://www.ulf.vn/scripts/server.php");

//        if(!@$session->login("pap-support@ulf.vn", 'xoWC$WBG89#z')) {
//            die("Cannot login. Message: ".$session->getMessage());
//        }

//        if(!@$session->login("phanvannhien@gmail.com", 'Vannhien@88')) {
//            die("Cannot login. Message: ".$session->getMessage());
//        }

        if(!@$session->login("nhienphan@ulf.vn", 'Vannhien@88')) {
            die("Cannot login. Message: ".$session->getMessage());
        }

        $request = new Pap_Api_TransactionsGrid($session);

        // list here all columns which you want to read from grid
        $request->addParam('columns', new Gpf_Rpc_Array(array(
            array('id'),
            array('transid'),
            array('campaignid'),
            array('orderid'),
            array('commission'),
            array('status'),
            array('userid')
        )));
        $request->addFilter('orderid', Gpf_Data_Filter::EQUALS, 'ORD_12345XYZ');
        $request->setLimit(0, 100);
        $request->setSorting('orderid', false);
        $request->sendNow();
        $grid = $request->getGrid();
        $recordset = $grid->getRecordset();

        dd($recordset);



    }
}
