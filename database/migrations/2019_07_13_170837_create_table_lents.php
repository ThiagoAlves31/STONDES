<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lents', function (Blueprint $table) {
            $table->increments('lent_id');
            
            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')
                  ->references('contact_id')
                  ->on('contacts')
                  ->onUpdate('cascade');
            
            $table->integer('product_id')->unique()->unsigned();
            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('products')
                  ->onUpdate('cascade');

            $table->date('lent_date');
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
        Schema::dropIfExists('lents');
    }
}
