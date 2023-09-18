<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesInboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_inboxes', function (Blueprint $table) {
            $table->id();
            $table->text('messages_headers')->nullable();
            $table->text('messages_playload')->nullable();
            $table->bigInteger('from_users_id')->index()->unsigned();
            $table->foreign('from_users_id')->references('id')->on('users');
            $table->bigInteger('to_users_id')->index()->unsigned();
            $table->foreign('to_users_id')->references('id')->on('users');
            $table->string('messages_dailog',65)->nullable();
            $table->bigInteger('media_id')->index()->unsigned();
            $table->foreign('media_id')->references('id')->on('media');
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
        Schema::dropIfExists('messages_inboxes');
    }
}
