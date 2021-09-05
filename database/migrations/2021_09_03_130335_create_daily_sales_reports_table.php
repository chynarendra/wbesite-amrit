<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailySalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_sales_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('app_user_id')->unsigned()->nullable();
            $table->foreign('app_user_id')->references('id')->on('app_users')->onUpdate('cascade');
            $table->string('visited_by');
            $table->string('visited_area');
            $table->string('serial_number')->nullable();
            $table->string('field_visit_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_sales_reports');
    }
}
