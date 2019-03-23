<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->increments('pid');
            $table->string('name');


            $table->string('category');
            $table->string('brand');
            
            
            $table->foreign('category')->references('name')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('brand')->references('name')->on('brands')->onDelete('cascade')->onUpdate('cascade');


            $table->double('price');
            $table->integer('quantity')->nullable();
            $table->enum('status',['0','1']);
            
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
        Schema::dropIfExists('products');
    }
}