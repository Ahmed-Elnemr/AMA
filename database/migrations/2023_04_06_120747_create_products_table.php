<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('products_name', 255)->nullable();
            $table->decimal('products_price', 10, 2)->nullable();
            $table->string('products_unite_name', 45)->nullable();
            $table->integer('products_uinites')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->bigInteger('users_id')->unsigned()->index();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('subcategories_id')->unsigned()->index()->nullable();
            $table->foreign('subcategories_id')->references('id')->on('sub_categories')->onDelete('set null');
            $table->bigInteger('main_categories_id')->unsigned()->index()->nullable();
            $table->foreign('main_categories_id')->references('id')->on('main_categories')->onDelete('set null');
            $table->bigInteger('categories_id')->unsigned()->index()->nullable();
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('set null');
            $table->bigInteger('business_information_id')->unsigned()->index()->nullable();
            $table->foreign('business_information_id')->references('id')->on('business_information')->onDelete('set null');
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
        Schema::dropIfExists('products');
    }
}
