<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('mobile')->unique()->nullable();
            $table->text('address')->nullable();
            $table->string('password');
            $table->bigInteger('office_id')->nullable();
            $table->bigInteger('designation_id')->unsigned();
            $table->foreign('designation_id')->references('id')->on('designations')->onUpdate('cascade');
            $table->string('image')->nullable();
            $table->enum('status',['0','1'])->default('1');
            $table->enum('block_status',['0','1'])->default('0');
            $table->text('fcm_token')->nullable();
            $table->date('register_date')->nullable();
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users')->onUpdate('cascade');
            $table->date('approved_date')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
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
        Schema::dropIfExists('app_users');
    }
}
