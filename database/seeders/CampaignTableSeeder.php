<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaign')->truncate();
        $rows = [
            [
                'city_id' => '1',
                'campaign_name' => 'Campaign First ',
                'start_date' => '2021-07-14',
                'end_date' => '2021-07-25',
                'created_at'=>'2021-07-28 14:57:38'
            ],
            [
                'city_id' => '2',
                'campaign_name' => 'Campaign Second ',
                'start_date' => '2021-08-14',
                'end_date' => '2021-08-22',
                'created_at'=>'2021-07-28 14:57:38'
            ],

        ];
        DB::table('campaign')->insert($rows);
    }
}
