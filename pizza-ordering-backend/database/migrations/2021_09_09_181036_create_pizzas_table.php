<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('pizza_category_id');
            $table->string('description');
            $table->json('ingredients');
            $table->integer('price');
            $table->integer('tax');
            $table->timestamps();
            $table->foreign('pizza_category_id')->references('id')->on('pizza_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizzas');
    }
}
