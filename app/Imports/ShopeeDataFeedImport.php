<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToModel;

class ShopeeDataFeedImport implements  WithHeadingRow, WithValidation, ToModel
{
    /**
    * @param Collection $collection
    */
    public function model( array $row )
    {

        dd($row);

    
        return null;

    }


    public function rules(): array
    {
        return [
            'order_id' => 'required',
            'product_id' => 'required',
            'status' => 'required',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function chunkSize(): int
    {
        return 5;
    }

    public function batchSize(): int
    {
        return 5;
    }
}
