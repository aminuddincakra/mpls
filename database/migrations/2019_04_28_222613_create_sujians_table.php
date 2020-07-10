<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sujians', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('siswa_id')->nullable();
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->unsignedInteger('server_id')->nullable();
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
            $table->unsignedInteger('sesi_id')->nullable();
            $table->foreign('sesi_id')->references('id')->on('sesis')->onDelete('cascade');
            $table->integer('hari')->nullable();
            $table->unsignedInteger('ssesi_id')->nullable();
            $table->foreign('ssesi_id')->references('id')->on('ssesis')->onDelete('cascade');
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
        Schema::dropIfExists('sujians');
    }
}
