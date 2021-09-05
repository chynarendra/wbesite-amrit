<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('office')->truncate();
        $rows = [
            [
                'office_type_id' => '1',
                'office_name' => 'Mahndra Purifier',
                'office_address' => 'Kathmandu',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ]

        ];
        DB::table('office')->insert($rows);
    }
}
