<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('notice_title')->nullable();
            $table->longText('notice_description')->nullable();
            $table->string('notice_file')->nullable();
            $table->date('notice_date')->nullable();
            $table->enum('notice_status',['0','1'])->default('0');
            $table->date('notice_publish_date')->nullable();
            $table->bigInteger('notice_publish_by')->unsigned()->nullable();
            $table->foreign('notice_publish_by')->references('id')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('publish_to_office_id')->nullable();
            $table->foreign('publish_to_office_id')->references('id')->on('users');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
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
        Schema::dropIfExists('notices');
    }
}
