<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreedersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('company_name', 250)->nullable();
            $table->string('owner_name', 250)->nullable();
            $table->string('company_about', 250)->nullable();
            $table->string('street', 250)->nullable();
            $table->string('city', 250)->nullable();
            $table->string('country', 250)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('website', 250)->nullable();
            $table->string('fb_url', 250)->nullable();
            $table->string('insta_url', 250)->nullable();
            $table->string('linkedin_url', 250)->nullable();
            $table->string('logo', 250)->nullable();
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
        Schema::dropIfExists('breeders');
    }
}
