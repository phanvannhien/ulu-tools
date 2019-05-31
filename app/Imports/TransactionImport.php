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

use GuzzleHttp\Client;

class TransactionImport implements  WithHeadingRow, WithValidation, ToModel
{

    protected $baseUrl;

    public function __construct()
    {
        if( env('APP_ENV') == 'local'){
            $this->baseUrl = env('API_LOCAL_BASE_URL');
        }else{
            $this->baseUrl = env('API_SERVER_BASE_URL');
        }

    }


    public function collection(Collection $rows)
    {
        dd($rows);
    }


    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model( array $row )
    {
       
        $url = $this->baseUrl.'/api/conversion/postback';
        $client = new Client();
        $response =  $client->request('GET', $url, [
            'query' => [
                'visitor_id' => $row['visitor_id'],
                'order_id' => $row['order_id'],
                'product_id' => $row['product_id'],
                'product_name' => $row['product_name'],
                'total_cost' => $row['total_cost'],
                'created_at' => $row['created_at'],
                'status' => $row['status']
            ]
        ]);
        $data = $response->getBody()->getContents();
        $data = json_decode( $data );
        return null ;

    }

    public function rules(): array
    {
        return [
            'visitor_id' => 'required',
            'order_id' => 'required',
            'product_id' => 'required',
            'product_name' => 'required',
            'total_cost' => 'required',
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