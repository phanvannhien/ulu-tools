<?php

namespace App\Http\Controllers;

use App\Imports\TransactionImport;
use Illuminate\Http\Request;



use Excel;

class TransactionController extends Controller
{
    public function index(Request $request){
        return view('admin.transactions.index', compact('recordset'));
    }

    public function check(Request $request){


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
