<?php

namespace App\Exports;

use App\Transaction;

use Maatwebsite\Excel\Concerns\FromArray;
use \Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExport implements FromArray, WithHeadings, WithMapping
{
    public $data;
    public $campaigns;
    public $affiliates;

    public function __construct($data, $campaigns, $affiliates = array() ){
        $this->data = $data;
        $this->campaigns = $campaigns;
        $this->affiliates = $affiliates;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'order_id',
            'campaign',
            'affiliate',
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
            $this->affiliates[ $sale->affiliate_id ],
            $sale->commission ,
            $sale->total_cost,
            $sale->status,
            Carbon::parse($sale->created_at)->setTimezone('Asia/Ho_Chi_Minh')
        ];

    }

    public function array() : array
    {
        return $this->data;
    }



}
