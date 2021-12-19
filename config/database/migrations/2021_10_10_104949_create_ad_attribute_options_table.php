<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdAttributeOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_attribute_options', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 75);
            $table->unsignedBigInteger('ad_attribute_id');
            $table->foreign('ad_attribute_id')->references('id')->on('ad_attributes');
            $table->boolean('status')->comment('those with 1 for status will be active and available for selection');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_attribute_options');
    }
}
