<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('action_user_id')->nullable();
            $table->foreign('action_user_id')->references('id')->on('users');
            $table->bigInteger('action_id')->nullable();
            $table->dateTime('action_date')->nullable();
            $table->string('action_device')->nullable();
            $table->string('action_ip')->nullable();
            $table->string('action_module')->nullable();
            $table->string('action_name')->nullable();
            $table->string('action_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_logs');
    }
}
