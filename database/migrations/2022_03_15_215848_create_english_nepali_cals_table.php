<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnglishNepaliCalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('english_nepali_cals', function (Blueprint $table) {
            $table->id();
            $table->integer('NEPALI_YEAR');
            $table->integer('MONTH_ID');
            $table->integer('TOTAL_DAYS');
            $table->string('START_DT_NEP');
            $table->integer('START_DT');
            $table->integer('END_DT');
            $table->integer('FISCAL_YR');
            $table->integer('FISCAL_YEAR');
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
        Schema::dropIfExists('english_nepali_cals');
    }
}
