<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistes', function (Blueprint $table) {
            $table->id();
            $table->integer('seances_id')->unsigned();
            $table->foreign('seances_id')->references('id')->on('seances');
            $table->integer('eleves_id')->unsigned();
            $table->foreign('eleves_id')->references('id')->on('eleves');
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
        Schema::dropIfExists('assistes');
    }
}
