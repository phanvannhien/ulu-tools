<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Imports\TransactionImport;
use App\Models\Sale;
use Illuminate\Http\Request;


use Excel;

class TransactionController extends Controller
{
    public function index(Request $request){

        $data = Sale::paginate();
        $total = Sale::sum('totalcost');

        return view('admin.transactions.index', compact('data', 'total'));
    }


    public function import(Request $request){

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
