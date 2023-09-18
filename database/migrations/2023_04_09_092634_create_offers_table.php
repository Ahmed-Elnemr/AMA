<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('offers_discount')->nullable();
            $table->timestamp('offers_start')->nullable();
            $table->timestamp('offers_end')->nullable();
            $table->string('offers_title',245)->nullable();
            $table->string('offers_code',245)->nullable();
            $table->integer('offers_limits')->nullable();
            $table->bigInteger('business_information_id')->index()->unsigned();
            $table->foreign('business_information_id')->references('id')->on('business_information');
            $table->bigInteger('media_id')->index()->unsigned();
            $table->foreign('media_id')->references('id')->on('media');
            $table->bigInteger('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('offers');
    }
}
