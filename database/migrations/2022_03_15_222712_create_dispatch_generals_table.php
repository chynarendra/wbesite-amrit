<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_generals', function (Blueprint $table) {
            $table->id();
            $table->string('FISCAL_YR');
            $table->string('DISPATCH_NO');
            $table->string('DISPATCH_METHOD');
            $table->string('DISPATCH_DT_NEP');
            $table->string('DISPATCH_DT_ENG');
            $table->string('REF_NO');
            $table->string('REF_DT_ENG')->nullable();
            $table->string('REF_DT_NEP')->nullable();
            $table->string('ISSUED_TO');
            $table->string('ADDRESS');
            $table->string('SUBJECT');
            $table->string('REMARKS')->nullable();
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
        Schema::dropIfExists('dispatch_generals');
    }
}
