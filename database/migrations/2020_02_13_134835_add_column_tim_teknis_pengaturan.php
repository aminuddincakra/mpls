<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTimTeknisPengaturan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengaturans', function (Blueprint $table) {
            $table->string('tanggung_jawab')->nullable();
            $table->string('nip_tanggung_jawab')->nullable();
            $table->string('telp_tanggung_jawab')->nullable();
            $table->string('proktor')->nullable();
            $table->string('email_proktor')->nullable();
            $table->string('telp_proktor')->nullable();
            $table->string('teknisi')->nullable();
            $table->string('email_teknisi')->nullable();
            $table->string('telp_teknisi')->nullable();
            $table->string('isp')->nullable();
            $table->string('pelanggan')->nullable();
            $table->string('koneksi')->nullable();
            $table->string('bandwidth')->nullable();
            $table->string('kontak')->nullable();
            $table->string('telephone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengaturans', function (Blueprint $table) {            
            $table->dropColumn('tanggung_jawab');
            $table->dropColumn('nip_tanggung_jawab');
            $table->dropColumn('telp_tanggung_jawab');
            $table->dropColumn('proktor');
            $table->dropColumn('email_proktor');
            $table->dropColumn('telp_proktor');
            $table->dropColumn('teknisi');
            $table->dropColumn('email_teknisi');
            $table->dropColumn('telp_teknisi');
            $table->dropColumn('isp');
            $table->dropColumn('pelanggan');
            $table->dropColumn('koneksi');
            $table->dropColumn('bandwidth');
            $table->dropColumn('kontak');
            $table->dropColumn('telephone');
        });
    }
}
