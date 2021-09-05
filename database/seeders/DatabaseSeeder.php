<?php

namespace Database\Seeders;
use App\Http\Controllers\Configurations\OfficeTypeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        //check foreign  key
        if(env('DB_CONNECTION') =='mysql')
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(MenusTableSeeder::class);
        $this->call(UserTypesTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LoginLogTableSeeder::class);
        $this->call(SystemSettingTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
        $this->call(OfficeTypeTableSeeder::class);
        $this->call(OfficeTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(CampaignTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        $this->call(ProductCategoryTableSeeder::class);
        $this->call(PaymentMethodTableSeeder::class);
        $this->call(SourceQueryTableSeeder::class);
        $this->call(FiscalYearsTableSeeder::class);
        $this->call(CustomerStatusTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}
