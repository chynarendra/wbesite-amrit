<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('office_type')->truncate();
        $rows = [
            [
                'name' => 'Head'
            ],
            [
                'name' => 'Branch'
            ]

        ];
        DB::table('office_type')->insert($rows);
    }
}
