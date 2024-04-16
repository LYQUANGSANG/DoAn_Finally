<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->string('image', 1000)->nullable();
            $table->string('memo', 1000)->nullable();
            $table->string('category_id', 225);
            $table->string('sub_category_id', 225);
            $table->integer('status');
            $table->integer('price');
            $table->boolean('isnew');
            $table->integer('views')->nullable();
            $table->integer('quantity_sold')->nullable();
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
        Schema::dropIfExists('product');
    }
};
