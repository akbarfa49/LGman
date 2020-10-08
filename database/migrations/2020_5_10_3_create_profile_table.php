<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->foreign('id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('Publisher_Name', 100)->nullable(false)->unique();
            $table->mediumText('Publisher_Description')->nullable();
            $table->string('Website_URL')->nullable();
            $table->increments('Publisher_id');
            $table->string('Address', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
