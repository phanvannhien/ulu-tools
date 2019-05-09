<?php

namespace App\Exports;

use App\Transaction;

use Maatwebsite\Excel\Concerns\FromArray;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExport implements FromArray, WithHeadings, WithMapping
{
    public $data;
    public $campaigns;

    public function __construct($data, $campaigns){
        $this->data = $data;
        $this->campaigns = $campaigns;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'order_id',
            'campaign',
            'commission',
            'total_cost',
            'status',
            'created_at'
        ];
    }

    public function map($sale): array
    {

        return [
            $sale->order_id,
            $this->campaigns[ $sale->campaign_id ],
            $sale->commission ,
            $sale->total_cost,
            $sale->status,
            $sale->created_at
        ];

    }

    public function array() : array
    {
        return $this->data;
    }
}
