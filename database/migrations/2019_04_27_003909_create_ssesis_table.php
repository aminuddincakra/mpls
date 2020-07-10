<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssesis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sesi_id')->nullable();
            $table->foreign('sesi_id')->references('id')->on('sesis')->onDelete('cascade');
            $table->integer('sesi')->nullable();
            $table->time('mulai')->nullable();
            $table->time('akhir')->nullable();
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
        Schema::dropIfExists('ssesis');
    }
}
