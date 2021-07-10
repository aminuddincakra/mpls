<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengumumenTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumumen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pengumumen');
    }
}
