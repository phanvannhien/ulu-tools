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

    public function email( $s ) {
        return $this->builder->where('email', 'LIKE', "%$s%");
    }

    public function userid( $s ) {
        return $this->builder->where('userid', 'LIKE', "%$s%");
    }

    public function full_name( $s ) {
        return $this->builder->where('full_name', 'LIKE', "%$s%");
    }

    public function phone( $s ) {
        return $this->builder->where('phone', 'LIKE', "%$s%");
    }


}