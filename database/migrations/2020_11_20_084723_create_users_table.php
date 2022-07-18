<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('login_user_name');
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('password');
            $table->bigInteger('user_type_id')->unsigned();
            $table->foreign('user_type_id')->references('id')->on('user_types')->onUpdate('cascade');
            $table->bigInteger('office_id')->nullable();
            $table->bigInteger('designation_id')->nullable();
            $table->string('image')->nullable();
            $table->enum('status',['0','1'])->default('1');
            $table->enum('block_status',['0','1'])->default('0');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
