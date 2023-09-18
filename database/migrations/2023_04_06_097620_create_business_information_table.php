<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_information', function (Blueprint $table) {
            $table->id();
            $table->string('legal_name',100);
            $table->string('slug_name',100);
            $table->foreignId('user_id')->index()->nullable();
            $table->bigInteger('cover_media_id')->unsigned()->index()->nullable();
            $table->foreign('cover_media_id')->references('id')->on('media');
            $table->bigInteger('logo_media_id')->unsigned()->index()->nullable();
            $table->foreign('logo_media_id')->references('id')->on('media');
            $table->bigInteger('categories_id')->unsigned()->index()->nullable();
            $table->foreign('categories_id')->references('id')->on('categories');


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
        Schema::dropIfExists('business_information');
    }
}
