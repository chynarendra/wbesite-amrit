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
            ],
            [
                'office_type_id' => '2',
                'office_name' => 'Itahari',
                'office_address' => 'Itahari',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],

            [
                'office_type_id' => '2',
                'office_name' => 'Biranagar / Morang',
                'office_address' => 'Biranagar / Morang',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],
            [
                'office_type_id' => '2',
                'office_name' => 'Lahan',
                'office_address' => 'Lahan',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],
            [
                'office_type_id' => '2',
                'office_name' => 'Damak',
                'office_address' => 'Damak',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],

            [
                'office_type_id' => '2',
                'office_name' => 'Dharan',
                'office_address' => 'Dharan',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],
            [
                'office_type_id' => '2',
                'office_name' => 'Birtamode',
                'office_address' => 'Birtamode',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],

            [
                'office_type_id' => '2',
                'office_name' => 'Hetauda',
                'office_address' => 'Hetauda',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],

            [
                'office_type_id' => '2',
                'office_name' => 'Birgunj',
                'office_address' => 'Birgunj',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],

            [
                'office_type_id' => '2',
                'office_name' => 'Urlabari / Jhapa',
                'office_address' => 'Urlabari / Jhapa',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],

            [
                'office_type_id' => '2',
                'office_name' => 'Bara',
                'office_address' => 'Bara',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],

            [
                'office_type_id' => '2',
                'office_name' => 'Chitwan',
                'office_address' => 'Chitwan',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],

            [
                'office_type_id' => '2',
                'office_name' => 'Butwal',
                'office_address' => 'Butwal',
                'office_phone' => '9801558301',
                'office_fb' => 'https://www.facebook.com/MahendraPurifier',
                'office_website' => 'https://mahendrapurifier.com',
                'status' => '1'
            ],

            

        ];
        DB::table('office')->insert($rows);
    }
}
