<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\APIs\Shopee;
use Illuminate\Support\Facades\Date;


class SyncReportShopee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopee:report {offer_type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync report shopee with param date: yyyy-mm-dd';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Shopee $shopee)
    {

        $date = Date::now()->subDays(5)->toDateString();
        $offer_type = $this->argument('offer_type') ?? 'tracking' ;

        $filterDate = [
            "conditional" => "GREATER_THAN_OR_EQUAL_TO",
            "values" => $date
        ];

        $shopee = $shopee->applyFilters( 'Stat.datetime', $filterDate );

        if( $offer_type == 'tracking'  ){
            $shopee = $shopee->applyFilters( 'Stat.offer_id', [
                "conditional" => "EQUAL_TO",
                "values" => [ 9,22 ]
            ]);
        }

        if( $offer_type == 'payment'  ){
            $shopee =  $shopee->applyFilters( 'Stat.offer_id', [
                "conditional" => "EQUAL_TO",
                "values" => [ 16, 21 ]
            ]);
        }


        $this->info('Fetching...');
        $shopee->getConversions()->syncToULU($offer_type);

        $this->info('Update has been send successfully');
    }
}
