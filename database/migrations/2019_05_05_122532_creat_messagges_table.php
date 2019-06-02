<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatMessaggesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('messages', function (Blueprint $table) {
          $table->Increments('id');
          $table->unsignedInteger('from_user_id');
          $table->foreign('from_user_id')->references('id')->on('users');
          $table->unsignedInteger('to_user_id');
          $table->foreign('to_user_id')->references('id')->on('users');
          $table->string('message');
          $table->datetime('edited_time');
          $table->softDeletes();
          $table->timestamps();
      });  //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('messages');
    }
}
