<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('propertyNumber');
            $table->string('primaryAddress');
            $table->string('secondaryAddress');
            $table->string('type');
            $table->string('status');
            $table->string('lotArea');
            $table->string('floorArea');
            $table->string('bedrooms');
            $table->string('bathrooms');
            $table->string('garage');
            $table->string('price');
            $table->longText('description');
            $table->boolean('isActive')->default(1);
            $table->boolean('isSold')->default(0);
            $table->boolean('isChosen')->default(0);
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
        Schema::dropIfExists('properties');
    }
}
