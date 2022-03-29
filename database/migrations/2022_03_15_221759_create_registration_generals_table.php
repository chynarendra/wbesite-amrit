<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_generals', function (Blueprint $table) {
            $table->id();
            $table->string('FISCAL_YR');
            $table->string('REG_NO');
            $table->string('REG_DT_NEP');
            $table->string('REG_DT_ENG');
            $table->string('REF_NO');
            $table->string('REF_DT_ENG');
            $table->string('REF_DT_NEP');
            $table->string('ISSUED_BY');
            $table->string('ADDRESS');
            $table->string('SUBJECT');
            $table->string('REMARKS');
            $table->string('ENTERED_BY');
            $table->string('ENTERED_DT_ENG');
            $table->string('ENTERED_DT_NEP');
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
        Schema::dropIfExists('registration_generals');
    }
}
