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
            $table->bigInteger('app_user_id')->unsigned()->nullable();
            $table->foreign('app_user_id')->references('id')->on('app_users')->onUpdate('cascade');
            $table->enum('status',['Approved','Cancelled','Pending'])->default('Pending');
            $table->string('leave_date');
            $table->text('reason');
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
