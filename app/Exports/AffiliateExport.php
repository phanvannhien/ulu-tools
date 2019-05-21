<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class AffiliateExport implements FromCollection, WithHeadings, WithMapping
{
    public $data;

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
            'user_id',
            'full_name',
            'email',
            'phone',
            'company',
            'website',
            'address'
        ];
    }

    public function map($user): array
    {

        return [
            $user->userid,
            $user->full_name,
            $user->email,
            $user->phone,
            $user->company,
            $user->website,
            $user->address,
        ];

    }

}
