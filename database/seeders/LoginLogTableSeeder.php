<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LoginLogTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('login_logs')->truncate();
        $rows = [
            [
                'user_id' => 1,
                'log_in_date' => '2020-10-16',
                'log_in_device'=>'Chrome 87.0.4280.66 Linux Desktop',
                'log_in_ip' => '127.0.0.1',
                'created_at'=>'2020-12-31 14:57:38'
            ],
            [
                'user_id' => 2,
                'log_in_date' => '2020-10-16',
                'log_in_device'=>'Chrome 87.0.4280.66 Linux Desktop',
                'log_in_ip' => '127.0.0.1',
                'created_at'=>'2020-12-31 14:57:38'
            ],
        ];
        DB::table('login_logs')->insert($rows);
    }
}
