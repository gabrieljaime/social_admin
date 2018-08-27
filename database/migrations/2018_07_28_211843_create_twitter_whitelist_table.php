<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterWhiteListTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('twitter_whitelist', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('social_id')->unsigned();
			$table->foreign('social_id')->references('id')->on('social_logins')->onDelete('cascade');
			$table->integer('friend_id')->unsigned();
			$table->text('profile_image_url');
		    $table->text('screen_name');
		    $table->text('name');
		    $table->text('verified');
		    $table->text('location');
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
		Schema::dropIfExists('twitter_whitelist');
	}
}
