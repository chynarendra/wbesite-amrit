<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $rows = [

            [
                'user_type_id' => 1,
                'full_name' => 'superadmin',
                'login_user_name' => 'superadmin',
                'email' => 'superadmin@admin.com',
                'password' => bcrypt('superadmin'),
                'status' => '1',
                'created_at' => '2020-10-10 14:57:38'
            ],
            [
                'user_type_id' => 2,
                'full_name' => 'Admin',
                'login_user_name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'status' => '1',
                'created_at' => '2020-10-10 14:57:38'
            ],
        ];
        DB::table('users')->insert($rows);
    }
}
