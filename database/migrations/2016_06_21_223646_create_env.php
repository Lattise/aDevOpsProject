<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('env', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
            $table->foreign('project')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('env');
    }
}
