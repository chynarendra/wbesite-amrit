<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('designations')->truncate();
        $rows = [
            [
                'name' => 'Manager',
                'short_name' => 'MA'
            ],
            [
                'name' => 'Business Development Manager',
                'short_name' => 'BDM'
            ],
            [
                'name' => 'SR. Sales Officer',
                'short_name' => 'SSO'
            ],
            [
                'name' => 'Sales Officer',
                'short_name' => 'SO'
            ],
            [
                'name' => 'Technician',
                'short_name' => 'TH'
            ]

        ];
        DB::table('designations')->insert($rows);
    }
}
