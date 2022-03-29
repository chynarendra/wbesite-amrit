<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUserMstsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user_msts', function (Blueprint $table) {
            $table->id();
            $table->integer('USER_ID');
            $table->string('USER_CD');
            $table->string('USER_PASSWORD');
            $table->string('USER_NAME_NEP');
            $table->string('USER_NAME_ENG');
            $table->string('USER_DESIGNATION');
            $table->enum('SUPER_FLAG',['N','A'])->default('N');
            $table->enum('ACTIVE',['A','I'])->default('A');
            $table->string('PREPARED_DT_ENG');
            $table->string('PREPARED_DT_NEP');
            $table->string('PREPARED_BY');
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
        Schema::dropIfExists('app_user_msts');
    }
}
