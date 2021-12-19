<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreederReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeder_reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('rating');
            $table->string('opinion', 300);
            $table->unsignedBigInteger('breeder_id');
            $table->foreign('breeder_id')->references('id')->on('breeders');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breeder_reviews');
    }
}
