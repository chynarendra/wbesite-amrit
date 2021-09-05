<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_category')->truncate();
        $rows = [
            [
                'name' => 'Water Purifier',
                'short_name' => 'Water Purifier'
            ],

            [
                'name' => 'Electric Appliance',
                'short_name' => 'Electric Appliance'
            ]

        ];
        DB::table('product_category')->insert($rows);
    }
}
