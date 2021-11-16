<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_purchase_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('app_user_id')->unsigned();
            $table->foreign('app_user_id')->references('id')->on('app_users');

            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('client_details');

            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('paid_amount')->default(0);

            $table->integer('purchase_office_id')->unsigned();
            $table->foreign('purchase_office_id')->references('id')->on('office');

            $table->string('purchase_date');
            $table->string('remarks')->nullable();

            $table->unsignedBigInteger('created_by_user_id')->nullable();
            $table->foreign('created_by_user_id')->references('id')->on('users');

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
        Schema::dropIfExists('client_purchase_products');
    }
}
