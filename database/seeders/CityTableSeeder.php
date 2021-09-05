<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('city')->truncate();
        $rows = [
            [
                'city_name' => 'Kathmandu',
                'district_id' => 27
            ],
            [
                'city_name' => 'Pokhara',
                'district_id' => 40
            ],
            [
                'city_name' => 'Tikapur',
                'district_id' => 71
            ],
            [
                'city_name' => 'Dhangadhi',
                'district_id' => 71
            ]

        ];
        DB::table('city')->insert($rows);
    }
}
