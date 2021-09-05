<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiscalYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fiscal_years')->truncate();
        $rows = [
            [
                'code' => '78/79',
                'start_date' => '2021-07-15',
                'end_date' => '2022-07-16',
                'status' =>'1'
            ],
            [
                'code' => '79/80',
                'start_date' => '2022-07-17',
                'end_date' => '2023-07-16',
                'status' =>'0'
            ],


        ];
        DB::table('fiscal_years')->insert($rows);
    }
}
