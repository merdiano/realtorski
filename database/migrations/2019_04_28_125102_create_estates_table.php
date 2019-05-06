<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('locationP')->nullable();
            $table->unsignedInteger('locationC')->nullable();
            $table->unsignedInteger('estate_type')->nullable();
            $table->unsignedSmallInteger('room')->nullable();
            $table->string('phone')->nullable();
            $table->enum('announcement_type',['sell','rent']);
            $table->foreign('locationP')->references('id')->on('locations');
            $table->foreign('locationC')->references('id')->on('locations');
            $table->foreign('estate_type')->references('id')->on('estate_types');
            $table->json('images')->nullable();
            $table->unsignedInteger('view')->default(0);
            $table->unsignedBigInteger('abonent_id');
            $table->foreign('abonent_id')->references('id')->on('abonents');
            $table->boolean('approved')->default(0);
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
        Schema::dropIfExists('estates');
    }
}
