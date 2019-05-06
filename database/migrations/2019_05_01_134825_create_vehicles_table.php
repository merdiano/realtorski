<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('mark');
            $table->unsignedInteger('model');
            $table->foreign('mark')->references('id')->on('marks');
            $table->foreign('model')->references('id')->on('marks');
            $table->year('year');
            $table->decimal('motor')->nullable();
            $table->unsignedInteger('probeg')->default(0);
            $table->boolean('kredit')->default(0);
            $table->boolean('obmen')->default(0);
            //renk
            $table->decimal('price')->default(0);
            $table->enum('karopka',['mehanika','tiptronik','awtomat']);

            $table->text('description')->nullable();
            $table->unsignedInteger('locationP')->nullable();
            $table->unsignedInteger('locationC')->nullable();
            $table->foreign('locationP')->references('id')->on('locations');
            $table->foreign('locationC')->references('id')->on('locations');
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
