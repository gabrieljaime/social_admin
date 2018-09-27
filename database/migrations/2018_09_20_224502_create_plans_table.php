<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('plans', function ($table) {

                $table->increments('id');
                $table->string('name');
                $table->string('stripe_id_m')->nullable($value = true);
                $table->string('mercadopago_id_m')->nullable($value = true);
                $table->string('stripe_id_y')->nullable($value = true);
                $table->string('mercadopago_id_y')->nullable($value = true);
                $table->integer('price_m');
                $table->integer('price_y');
                $table->integer('profile');
                $table->integer('social');
                $table->integer('agended');
                $table->integer('feed');
                $table->integer('automatic');
                $table->boolean('whitelist')->default(false);
                $table->boolean('unfollowall')->default(false);
                $table->boolean('ranking')->default(false);
                $table->boolean('active')->default(true);
                $table->unsignedInteger('user_id')->nullable($value = true);
                $table->foreign('user_id')->references('id')->on('users');
                $table->timestamps();
                $table->softDeletes();


            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');

    }
}
