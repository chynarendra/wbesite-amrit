<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('province')->truncate();
        $rows = [
            [
                'name_en' => 'Province 1',
                'name_np' => 'प्रदेश नम्बर १',
                'code' => '1'
            ],
            [
                'name_en' => 'Province 2',
                'name_np' => 'प्रदेश नम्बर २',
                'code' => '2'
            ],
            [
                'name_en' => 'Bagmati',
                'name_np' => 'बागमती प्रदेश',
                'code' => '3'
            ],
            [
                'name_en' => 'Gandaki',
                'name_np' => 'गण्डकी प्रदेश',
                'code' => '4'
            ],
            [
                'name_en' => 'Province 5, Lumbini',
                'name_np' => 'लुम्बिनी प्रदेश',
                'code' => '5'
            ],
            [
                'name_en' => 'Karnali',
                'name_np' => 'कर्णाली प्रदेश',
                'code' => '6'
            ],
            [
                'name_en' => 'Sudurpaschim',
                'name_np' => 'सुदूरपश्चिम प्रदेश',
                'code' => '7'
            ],

        ];
        DB::table('province')->insert($rows);
    }
}
