<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_answered', 3);
            $table->string('answered_correctly', 3)->nullable();
            $table->integer('performance_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->foreign('performance_id')
                  ->references('id')->on('performances')
                  ->onDelete('cascade');
            $table->foreign('question_id')
                  ->references('id')->on('questions')
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
        Schema::dropIfExists('performance_questions');
    }
}
