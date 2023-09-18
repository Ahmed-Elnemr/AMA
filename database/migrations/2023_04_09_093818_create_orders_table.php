<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status',45)->nullable();
            $table->double('total',2);
            $table->bigInteger('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('business_information_id')->index()->unsigned();
            $table->foreign('business_information_id')->references('id')->on('business_information');
            $table->bigInteger('address_id')->index()->unsigned();
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->decimal('addresses',10,2)->nullable();
            $table->string('orderscol',45)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
