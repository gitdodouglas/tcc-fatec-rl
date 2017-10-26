<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('topic', 60);
            $table->string('description', 500);
            $table->integer('number_sequence')->unsigned();
            $table->integer('quantity_questions')->unsigned();
            $table->string('minimum_hit', 3);
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')
                  ->references('id')->on('levels')
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
        Schema::dropIfExists('topics');
    }
}
