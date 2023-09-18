<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->timestamp('stories_start_date')->nullable();
            $table->timestamp('stories_end_date')->nullable();
            $table->enum('stories_type',['VIDEO','IMAGE','TEXT']);
            $table->text('stories_captions');
            $table->string('stories_background',45);
            $table->foreignId('media_id')->index()->nullable();
            $table->foreignId('user_id')->index()->nullable();
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
        Schema::dropIfExists('stories');
    }
}
