<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name', 100);
            $table->tinyInteger('room_is_private');
            $table->string('chat_key', 200);
            $table->bigInteger('media_id')->unsigned()->index()->nullable();
            $table->foreign('media_id')->references('id')->on('media');
            $table->bigInteger('owner_users_id')->unsigned()->index()->nullable();
            $table->foreign('owner_users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('chat_rooms');
    }
}
