<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceQueryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('source_query')->truncate();
        $rows = [
            [
                'name' => 'Facebook',
            ],

            [
                'name' => 'Whatsapp',
            ],
            [
                'name' => 'Instagaram',
            ],
            [
                'name' => 'Email',
            ],
            [
                'name' => 'Phone',
            ],
            [
                'name' => 'Campaign',
            ]

        ];
        DB::table('source_query')->insert($rows);
    }
}
