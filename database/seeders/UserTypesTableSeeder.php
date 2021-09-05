<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->truncate();
        $rows = [
            [
                'type_name' => 'Super Admin',
                'status' => '1'
            ],
            [
                'type_name' => 'Admin',
                'status' => '1'
            ],
            [
                'type_name' => 'General User',
                'status' => '1'
            ]
        ];
        DB::table('user_types')->insert($rows);
    }
}
