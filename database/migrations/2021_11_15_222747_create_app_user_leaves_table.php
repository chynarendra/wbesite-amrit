<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUserLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user_leaves', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('app_user_id')->unsigned()->nullable();
            $table->foreign('app_user_id')->references('id')->on('app_users')->onUpdate('cascade');
            $table->string('month_start_date');
            $table->string('month_end_date');
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
        Schema::dropIfExists('app_user_leaves');
    }
}
