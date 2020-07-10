<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ujian_id')->nullable();
            $table->foreign('ujian_id')->references('id')->on('ujians')->onDelete('cascade');
            $table->text('soal');
            $table->text('jawab1');
            $table->text('jawab2');
            $table->text('jawab3');
            $table->text('jawab4');
            $table->text('jawab5');
            $table->integer('jawaban')->default(0);
            $table->integer('level')->default(0);
            $table->integer('group')->default(0);
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
        Schema::dropIfExists('soals');
    }
}
