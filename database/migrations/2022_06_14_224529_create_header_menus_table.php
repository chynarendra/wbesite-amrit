<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('parent_menu_id')->nullable();
            $table->string('module_url')->nullable();
            $table->string('page_url')->nullable();
            $table->string('external_url')->nullable();
            $table->enum('menu_type',['module','url','page'])->default('page');
            $table->integer('display_order');
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('header_menus');
    }
}
