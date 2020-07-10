<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnKelasJurusanUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('kelas')->nullable();
            $table->string('jurusan')->nullable();            
            $table->string('wali_kelas')->nullable();          
            $table->text('link')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {            
            $table->dropColumn('kelas');
            $table->dropColumn('jurusan');
            $table->dropColumn('wali_kelas');
            $table->dropColumn('link');
        });
    }
}
