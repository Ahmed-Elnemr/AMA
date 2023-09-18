<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('subscription_start')->nullable();
            $table->timestamp('subscription_end')->nullable();
            $table->integer('duration_in_days');
            $table->bigInteger('subscription_pkg_id')->unsigned()->index()->nullable();
            $table->foreign('subscription_pkg_id')->references('id')->on('subscription_pkgs');
            $table->bigInteger('user_id')->unsigned()->index()->nullable()->onUpdate('set null');
            $table->bigInteger('business_information_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}
