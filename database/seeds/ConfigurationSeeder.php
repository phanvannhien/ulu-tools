<?php

use Illuminate\Database\Seeder;

use App\Models\Configuration;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'label' => 'Time sync Shopee conversion ( Offer )',
                'group' => 'default',
                'name' => 'cron_time_conversion',
                'value' => '5',
                'type' => 'text',
            ],
            [
                'label' => 'Time sync Shopee conversion ( Payment )',
                'group' => 'default',
                'name' => 'cron_time_payment',
                'value' => '5',
                'type' => 'text',
            ],
        ];

        foreach ( $arr as $item ){
            Configuration::create($item);
        }
    }
}
