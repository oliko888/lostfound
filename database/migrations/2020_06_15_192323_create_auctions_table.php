<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('categories_id');
            $table->string('description', 150)->nullable();
            $table->integer('location');
            $table->string('image', 150)->nullable();
            $table->integer('bet')->nullable();//FLOAT MITTE INT
            /* $table->string('winner', 50)->nullable(); */
            $table->string('email', 100)->nullable();
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
        Schema::dropIfExists('auctions');
    }
}
