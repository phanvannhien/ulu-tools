<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Crons\SyncAffiliate;

class SyncAffiliatePAP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ulu:sync {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync affiliate user from PAP';

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
    public function handle(SyncAffiliate $sync )
    {
        $type = $this->argument('type') ;
        //
        $this->info('Fetching...');
        if( $type == 'affiliate' ){
            $sync->sync();
        }
        
        $this->info('Done...');

    }
}
