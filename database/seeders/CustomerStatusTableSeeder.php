<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_status')->truncate();
        $rows = [
            [
                'name' => 'Hot',
                'status' => '1'
            ],
            [
                'name' => 'Warm',
                'status' => '1'
            ],
            [
                'name' => 'Confirmed',
                'status' => '1'
            ],
            [
                'name' => 'Cold',
                'status' => '1'
            ],
            [
                'name' => 'Install',
                'status' => '1'
            ],

        ];
        DB::table('customer_status')->insert($rows);
    }
}
