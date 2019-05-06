<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('images')->nullable();
            $table->string('title');
            $table->text('description');
            $table->decimal('price')->nullable();
            $table->unsignedInteger('locationP')->nullable();
            $table->unsignedInteger('locationC')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('categoryP')->nullable();
            $table->unsignedInteger('categoryC')->nullable();
            $table->unsignedInteger('view')->default(0);
            $table->unsignedBigInteger('abonent_id');
            $table->foreign('abonent_id')->references('id')->on('abonents');
            $table->boolean('approved')->default(0);
            $table->foreign('locationP')->references('id')->on('locations');
            $table->foreign('locationC')->references('id')->on('locations');
            $table->foreign('categoryP')->references('id')->on('categories');
            $table->foreign('categoryC')->references('id')->on('categories');


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
        Schema::dropIfExists('kids');
    }
}
