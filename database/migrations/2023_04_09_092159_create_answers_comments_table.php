<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers_comments', function (Blueprint $table) {
            $table->id();
            $table->text('answers_comments_playload')->nullable();
            $table->string('answers_commentscol',45)->nullable();
            $table->bigInteger('answers_id')->index()->unsigned();
            $table->foreign('answers_id')->references('id')->on('answers');
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
        Schema::dropIfExists('answers_comments');
    }
}
