<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUjiansTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujians', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users'
                )->onDelete('cascade');
            $table->unsignedInteger('mapel_id')->nullable();
            $table->foreign('mapel_id')->references('id')->on('mapels')->onDelete('cascade');
            $table->string('name');
            $table->integer('randomno')->default(0);
            $table->integer('randompil')->default(0);
            $table->integer('public')->default(0);
            $table->integer('kelas')->default(0);
            $table->integer('jumlah')->default(0);
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
        Schema::drop('ujians');
    }
}
