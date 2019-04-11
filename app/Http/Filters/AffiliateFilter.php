<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\Filters\QueryFilters;



class AffiliateFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function username( $s ) {
        return $this->builder->where('username', 'LIKE', "%$s%");
    }

    public function userid( $s ) {
        return $this->builder->where('userid', 'LIKE', "%$s%");
    }

    public function fullname( $s ) {
        return $this->builder->where('fullname', 'LIKE', "%$s%");
    }

    public function data8( $s ) {
        return $this->builder->where('data8', 'LIKE', "%$s%");
    }


}