<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsesis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sesi_id')->nullable();
            $table->foreign('sesi_id')->references('id')->on('sesis')->onDelete('cascade');
            $table->unsignedInteger('ujian_id')->nullable();
            $table->foreign('ujian_id')->references('id')->on('ujians')->onDelete('cascade');
            $table->date('hari')->nullable();
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
        Schema::dropIfExists('dsesis');
    }
}
