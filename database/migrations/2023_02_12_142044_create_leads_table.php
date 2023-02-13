<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_type');
            $table->string('f_name')->nullable();
            $table->string('m_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->string('type')->nullable();
            $table->string('lot_area_min')->nullable();
            $table->string('lot_area_max')->nullable();
            $table->string('price_min')->nullable();
            $table->string('price_max')->nullable();
            $table->string('price_per_sqm')->nullable();
            $table->string('price_total')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('leads');
    }
}
