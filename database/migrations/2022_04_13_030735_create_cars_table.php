<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('number_plate')->unique();
            $table->string('chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->integer('manufacturer_id');
            $table->integer('custom_id');
            $table->integer('color_id');
            $table->integer('type_id');
            $table->integer('insurance_id');
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
        Schema::dropIfExists('cars');
    }
}
