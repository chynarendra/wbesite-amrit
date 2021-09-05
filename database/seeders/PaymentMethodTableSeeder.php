<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('payment_method')->truncate();
        $rows = [
            [
                'method_name' => 'Esewa',
            ],

            [
                'method_name' => 'Khalti',
            ],

            [
                'method_name' => 'Cash',
            ],
            [
                'method_name' => 'Bank transfer',
            ]

        ];
        DB::table('payment_method')->insert($rows);
    }
}
