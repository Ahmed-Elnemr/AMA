<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('points',45)->nullable();
            $table->text('users_review_text')->nullable();
            $table->bigInteger('by_users_id')->index()->unsigned();
            $table->foreign('by_users_id')->references('id')->on('users');
            $table->bigInteger('for_users_id')->index()->unsigned();
            $table->foreign('for_users_id')->references('id')->on('business_information');
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
        Schema::dropIfExists('user_reviews');
    }
}
