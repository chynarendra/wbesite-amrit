<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('app_user_id')->unsigned()->nullable();
            $table->foreign('app_user_id')->references('id')->on('app_users')->onUpdate('cascade');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('no')->nullable();
            $table->string('tds')->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('customer_status')->onUpdate('cascade');
            $table->text('remarks')->nullable();
            $table->enum('data_type',['old','new'])->default('new');
            $table->string('date_of_visit');
            $table->string('next_date_of_visit')->nullable();
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
        Schema::dropIfExists('client_details');
    }
}
