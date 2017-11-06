<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('nickname', 20);
            $table->date('birth');
            $table->string('email', 60)->unique();
            $table->string('password', 60);
            $table->integer('type_user_id')->unsigned();
            $table->foreign('type_user_id')
                  ->references('id')->on('type_users')
                  ->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('activated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
