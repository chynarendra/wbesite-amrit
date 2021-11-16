<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('month_leaves', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('app_user_leave_id')->unsigned()->nullable();
            $table->foreign('app_user_leave_id')->references('id')->on('app_user_leaves')->onUpdate('cascade');
            $table->enum('leave_type',['leave','holiday'])->default('leave');
            $table->string('leave_date');
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
        Schema::dropIfExists('month_leaves');
    }
}
