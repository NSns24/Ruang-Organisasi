<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('user_from');
            $table->foreign('user_from')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_to')->nullable();
            $table->foreign('user_to')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('chat_message');
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
        Schema::dropIfExists('chats');
    }
}
