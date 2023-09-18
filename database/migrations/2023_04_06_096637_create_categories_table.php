<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('categories_title',45);
            $table->string('categories_body',45);
            $table->bigInteger('main_categories_id')->unsigned()->index()->nullable();
            $table->foreign('main_categories_id')->references('id')->on('main_categories') ->onDelete('cascade');
            $table->bigInteger('media_id')->unsigned()->index()->nullable();
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
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
        Schema::dropIfExists('categories');
    }
}
