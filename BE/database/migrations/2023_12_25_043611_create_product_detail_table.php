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
        Schema::create('product_detail', function (Blueprint $table) {
            $table->id();
            $table->string('product_id', 225);
            $table->string('cpu', 225);
            $table->integer('ram');
            $table->double('display_size');
            $table->string('display_memo', 225)->nullable();
            $table->integer('capacity_rom')->nullable();
            $table->integer('type_rom')->nullable();
            $table->string('camera', 225)->nullable();
            $table->string('weight', 225);
            $table->string('battery', 225);
            $table->text('description', 10000)->nullable();
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
        Schema::dropIfExists('product_detail');
    }
};
