<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('social_id')->unsigned();
            $table->text('feed');
            $table->string('name',100);
            $table->string('begin',50)->nullable();
            $table->string('end',50)->nullable();
            $table->integer('term_to_check');
            $table->integer('post_by_check');
            $table->integer('daily_posts');
            $table->boolean('shorten_url')->default(true);
            $table->boolean('active')->default(true);
            $table->text('last_public');
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
        Schema::dropIfExists('feeds');
    }
}
