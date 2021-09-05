<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('office_type_id')->nullable();
            $table->string('office_name');
            $table->string('office_address')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('office_fb')->nullable();
            $table->string('office_website')->nullable();
            $table->enum('status',['1','0'])->default('1');
            $table->softDeletes();
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
        Schema::dropIfExists('office');
    }
}
