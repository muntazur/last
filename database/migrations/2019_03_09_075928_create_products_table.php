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

            $table->integer('user_id')->unsigned();

            $table->string('category');
            $table->string('brand');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->foreign('category')->references('name')->on('categories')->onDelete('cascade');
            $table->foreign('brand')->references('name')->on('brands')->onDelete('cascade');


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