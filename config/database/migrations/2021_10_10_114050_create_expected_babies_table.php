<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpectedBabiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expected_babies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 75);
            $table->date('expected_at');
            $table->string('desc', 300)->nullable();
            $table->string('father', 75)->nullable();
            $table->string('mother', 75)->nullable();
            $table->string('father_pic', 250)->nullable();
            $table->string('mother_pic', 250)->nullable();
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
        Schema::dropIfExists('expected_babies');
    }
}
