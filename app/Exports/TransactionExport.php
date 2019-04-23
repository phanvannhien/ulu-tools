<?php

namespace App\Exports;

use App\Transaction;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExport implements FromCollection, WithHeadings, WithMapping
{
    public $data;

    public function __construct($data){
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            't_orderid',
            'affiliate',
            'advertiser',
            'totalcost',
            'commission',
            'rstatus',
            'date'
        ];
    }

    public function map($sale): array
    {

        return [
            $sale->t_orderid,
            ($sale->affiliate) ? $sale->affiliate->full_name : '',
            ($sale->advertiser ) ? $sale->advertiser->account : '',
            $sale->totalcost,
            $sale->commission,
            config('ulu.commission_status')[$sale->rstatus],
            $sale->conversion_date
        ];

    }

    public function collection()
    {
        return $this->data;
    }
}
