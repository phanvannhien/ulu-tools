<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;



class TrafficExport implements FromArray,  WithHeadings, WithMapping
{
    public $data;
    public $campaigns;
    public $affiliates;

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'traffic_id',
            'affiliate_id',
            'affiliate_name',
            'campaign_id',
            'campaign_name',
            'url',
            'ip',
            'user_agent',
            'md5_agent',
            'type',
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'aff_sub1',
            'aff_sub2',
            'created_at',
        ];
    }

    public function map($row): array
    {

        return [
            $row->id,
            isset($row->affiliate_id) ? $row->affiliate_id : '' ,
            isset($row->affiliate_id) && isset( $this->affiliates[ $row->affiliate_id ]) ? $this->affiliates[ $row->affiliate_id ] : '',
            isset($row->campaign_id) ? $row->campaign_id: '',
            isset($row->campaign_id) && isset($this->campaigns[ $row->campaign_id ]) ? $this->campaigns[ $row->campaign_id ] : '',
            $row->url,
            $row->ip,
            $row->user_agent,
            $row->md5_agent,
            $row->type,
            isset($row->utm_source) ? $row->utm_source : '',
            isset($row->utm_medium) ? $row->utm_medium : '',
            isset($row->utm_campaign) ? $row->utm_campaign : '',
            isset($row->aff_sub1) ? $row->aff_sub1 : '',
            isset($row->aff_sub2) ? $row->aff_sub2 : '',
            $row->created_at,
        ];

    }


    public function array() : array
    {
        return $this->data;
    }

}
