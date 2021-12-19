<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 75);
            $table->string('desc', 300);
            $table->decimal('amount', 8, 2); 
            $table->unsignedBigInteger('race_id');
            $table->foreign('race_id')->references('id')->on('races');
            $table->unsignedBigInteger('kind_id');
            $table->foreign('kind_id')->references('id')->on('kinds');
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
        Schema::dropIfExists('ads');
    }
}
