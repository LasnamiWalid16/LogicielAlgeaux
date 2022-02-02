<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->text('nbplaces');
            $table->text('jours');
            $table->text('heured');
            $table->text('heuref');
            $table->text('prix');
            $table->integer('classes_id')->unsigned();
            $table->foreign('classes_id')->references('id')->on('classes');
            $table->integer('cours_id')->unsigned();
            $table->foreign('cours_id')->references('id')->on('cours');
            $table->integer('profs_id')->unsigned();
            $table->foreign('profs_id')->references('id')->on('profs');
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
        Schema::dropIfExists('sessions');
    }
}
