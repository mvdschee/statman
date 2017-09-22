<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InviteTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invite_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token');
            $table->integer('project_id')->unsigned();
            $table->integer('role_index_id')->unsigned();
            $table->string('invited_email');
            $table->timestamps();
        });
        Schema::table('invite_tokens', function (Blueprint $table) {
            $table->foreign('role_index_id')->references('id')->on('role_index');
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invite_tokens');
    }
}
