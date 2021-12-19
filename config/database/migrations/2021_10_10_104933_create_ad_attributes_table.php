<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_attributes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 75);
            $table->unsignedBigInteger('kind_id');
            $table->foreign('kind_id')->references('id')->on('kinds');
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
        Schema::dropIfExists('ad_attributes');
    }
}
