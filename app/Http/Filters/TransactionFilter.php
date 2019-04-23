<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\Filters\QueryFilters;



class TransactionFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function userid( $s ) {
        return $this->builder->where('userid', $s);
    }

    public function accountid( $s ) {
        return $this->builder->where('accountid', $s );
    }

    public function conversion_date( $s ) {
        $arr = explode('-', $s);
        if( $arr[0] )
            $this->builder->where('conversion_date','>=', $arr[0]);
        if( $arr[1] )
            $this->builder->where('conversion_date','<=', $arr[1]);
        return $this;
    }



}