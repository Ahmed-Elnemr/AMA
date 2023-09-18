<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_locations', function (Blueprint $table) {
            $table->id();
            $table->string('country',45)->nullable();
            $table->string('city',45)->nullable();
            $table->string('street',45)->nullable();
            $table->string('landmark',45)->nullable();
            $table->string('building',45)->nullable();
            $table->string('floor',45)->nullable();
            $table->string('flat',45)->nullable();
            $table->bigInteger('business_information_id')->index()->unsigned();
            $table->foreign('business_information_id')->references('id')->on('business_information');
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
        Schema::dropIfExists('vendor_locations');
    }
}
