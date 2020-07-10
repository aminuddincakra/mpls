<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSesi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sesis', function (Blueprint $table) {
            $table->date('awal')->nullable();
            $table->date('akhir')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sesis', function (Blueprint $table) {
            $table->dropColumn('awal');
            $table->dropColumn('akhir');
        });
    }
}
