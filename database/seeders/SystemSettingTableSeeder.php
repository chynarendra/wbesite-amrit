<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_settings')->truncate();
        $rows = [
            [
                'app_name' => 'Log In',
                'mail_driver' => 'smtp',
                'mail_host_name' => 'smtp.mailtrap.io',
                'mail_port' => '2525',
                'mail_from_address' => 'admin@support.com',
                'mail_user_name' => '1af0198361ad39',
                'mail_password' => '8ce2303fbb472e',
                'mail_encryption' => 'tls',
                'login_attempt_limit' => '5',
                'login_title' => 'Sign In to start your session',
            ],
        ];
        DB::table('system_settings')->insert($rows);
    }
}
