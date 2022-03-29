<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_methods', function (Blueprint $table) {
            $table->id();
            $table->string('METHOD_CD');
            $table->string('ABBR');
            $table->string('DESC_ENG');
            $table->string('DESC_NEP');
            $table->string('DISABLED');
            $table->string('ORDER_NO');
            $table->string('ENTERED_BY');
            $table->string('ENTERED_DT');
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
        Schema::dropIfExists('dispatch_methods');
    }
}
