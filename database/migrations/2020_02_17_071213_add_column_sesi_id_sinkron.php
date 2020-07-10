<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSesiIdSinkron extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sinkrons', function (Blueprint $table) {
            $table->unsignedInteger('sesi_id')->nullable();
            $table->foreign('sesi_id')->references('id')->on('sesis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sinkrons', function (Blueprint $table) {
            $table->dropForeign('sinkrons_sesi_id_foreign');
            $table->dropColumn('sesi_id');            
        });
    }
}
