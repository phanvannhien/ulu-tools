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
    protected $signature = 'shopee:report {date?}';

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

        $date = $this->argument('date') ??  Date::now()->toDateString();

        $filterDate = [
            "conditional" => "GREATER_THAN_OR_EQUAL_TO",
            "values" => $date
        ];

        $this->info('Fetching...');
        $shopee->applyFilters( 'Stat.datetime', $filterDate )
            ->getConversions()->syncToULU();
        $this->info('Update has been send successfully');
    }
}
