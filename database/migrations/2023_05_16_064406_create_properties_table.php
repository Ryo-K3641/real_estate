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
            $table->id();
            $table->string('description', 50);
            $table->text('summary');
            $table->string('image', 50);
            $table->integer('bedrooms');
            $table->decimal('bathrooms', 3, 1);
            $table->decimal('floor_area', 6, 2)->comment('sqm');
            $table->string('country', 50);
            $table->string('address');
            $table->unsignedBigInteger('property_type_id');
            $table->timestamps();

            $table->foreign('property_type_id')->references('id')->on('property_types');
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
