<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lugar');
            $table->string('estado');

            $table->unsignedBigInteger('id_pedido')->nullable();
            $table->foreign('id_pedido')->references('id')
                  ->on('orders')->onDelete('cascade');

            $table->unsignedBigInteger('id_establecimiento')->nullable();
            $table->foreign('id_establecimiento')->references('id')
                  ->on('establishments')->onDelete('cascade');

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
        Schema::dropIfExists('trackings');
    }
}
