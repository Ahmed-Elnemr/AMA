<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->text('reson');
            $table->string('status',45);
            $table->bigInteger('by_user_id')->unsigned()->index()->nullable();
            $table->foreign('by_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('for_user_id')->unsigned()->index()->nullable();
            $table->foreign('for_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_reports');
    }
}
