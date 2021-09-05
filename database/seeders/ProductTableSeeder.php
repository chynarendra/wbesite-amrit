<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        $rows = [
            [
                'product_name' => 'Water Purifier',
                'campaign_id' =>1,
                'product_category_id' =>1,
                'warrenty_in_years' =>4,
            ],

            [
                'product_name' => 'Electric Appliance',
                'campaign_id' =>1,
                'product_category_id' =>1,
                'warrenty_in_years' =>5,
            ]

        ];
        DB::table('products')->insert($rows);
    }
}
