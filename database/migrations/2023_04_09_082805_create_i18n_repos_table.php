<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateI18nReposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i18n_repos', function (Blueprint $table) {
            $table->id();
            $table->String('i18n_class_name')->nullable();
            $table->String("i18n_data")->nullable();
            $table->bigInteger('i18n_refrance_id')->nullable();
            $table->String('i18n_lang_iso')->nullable();
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
        Schema::dropIfExists('i18n_repos');
    }
}
