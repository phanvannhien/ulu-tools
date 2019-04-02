<?php

namespace App\Imports;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Pap_Api_TransactionsGrid;
use Pap_Api_Transaction;
use Gpf_Data_Filter;
use Gpf_Rpc_Array;
use Gpf_Data_Record;

class TransactionImport implements  WithHeadingRow, WithValidation, ToModel
{

    public function collection(Collection $rows)
    {
        dd($rows);
        foreach ($rows as $row)
        {
            User::create([
                'name' => $row[0],
            ]);
        }
    }


    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model( array $row )
    {
        $session = session()->get('user')['session'];
        $sale = new Pap_Api_Transaction($session);

        $sale->setOrderId( $row['order_id'] );
        $sale->setProductId($row['product_id']);

        if ($sale->load()) {

            if( $sale->getStatus()  == 'P' ){
                $sale->setStatus('A');
                $sale->setMerchantNote('transaction verified');
                $sale->save();
            }
        }

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
        return 100;
    }
}