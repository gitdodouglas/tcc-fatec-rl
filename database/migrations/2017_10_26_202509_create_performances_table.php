<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('user_email', 60);
            $table->integer('topic_id')->unsigned();
            $table->integer('status_performance_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('user_email')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('topic_id')
                  ->references('id')->on('topics')
                  ->onDelete('cascade');
            $table->foreign('status_performance_id')
                  ->references('id')->on('status_performances')
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
        Schema::dropIfExists('performances');
    }
}
