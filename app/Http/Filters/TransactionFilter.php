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

    public function campaign_id( $s ) {
        return $this->builder->where('campaignid', $s );
    }



    public function conversion_date( $s ) {
        $arr = explode('-', $s);

        $startDate = str_replace('/','-',trim($arr[0]));
        $endDate = str_replace('/','-',trim($arr[1]));


        if( $startDate )
            $this->builder->whereDate('conversion_date','>=', $startDate  );
        if( $endDate )
            $this->builder->whereDate('conversion_date','<=', $endDate ) ;
        return $this;
    }



}