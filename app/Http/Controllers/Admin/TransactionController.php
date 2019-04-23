<?php
namespace App\Http\Controllers\Admin;
use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;

use App\Http\Filters\TransactionFilter;
use App\Imports\TransactionImport;
use App\Models\Sale;
use Illuminate\Http\Request;


use Excel;
use Str;

class TransactionController extends Controller
{
    public function index(Request $request, TransactionFilter $filter){

        $data = Sale::filter($filter)->orderBy('conversion_date', 'DESC');
        $total = $data->sum('totalcost');

        if( $request->input('action') == 'download' ){
            return Excel::download( new TransactionExport(  $data->get() ), 'conversion'. str_replace('/','-', $request->get('conversion_date') ).'.xlsx' );
        }

        $data = $data->paginate(100);
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
