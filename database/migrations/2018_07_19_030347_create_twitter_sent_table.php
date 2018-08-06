<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterSentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_sent', function (Blueprint $table) {
            $table->increments('id');
            $table->text('twitt_id');
            $table->integer('user_id')->unsigned();
            $table->integer('social_id')->unsigned();
            $table->text('text');
            $table->text('file')->nullable();;
            $table->text('link')->nullable();;
            $table->text('origin');
            $table->text('origin_id');
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
        Schema::dropIfExists('twitter_sent');
    }
}
