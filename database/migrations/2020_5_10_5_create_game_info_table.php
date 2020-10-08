<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_info', function (Blueprint $table) {
            $table->unsignedInteger('Publisher_id');
            $table->foreign('Publisher_id')->references('Publisher_id')->on('profile')->onUpdate('cascade')->onDelete('cascade');
            $table->increments('Game_id');
            $table->string('Name',15)->unique();
            $table->string('Genre', 10)->nullable();
            $table->text('Game_Desc')->nullable();
            $table->string('Site')->nullable();
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
        Schema::dropIfExists('game_info');
    }
}
