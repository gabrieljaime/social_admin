<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('twitter_agenda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('social_id')->unsigned();
            $table->foreign('social_id')->references('id')->on('social_login')->onDelete('cascade');
            $table->text('name');
            $table->text('text',258);
            $table->text('image')->nullable();
            $table->text('link')->nullable();
            $table->date('publication_date')->nullable();
            $table->time('publication_at')->nullable();
            $table->integer('frequency')->nullable();
            $table->boolean('active');
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
        Schema::dropIfExists('twitter_agenda');
    }
}
