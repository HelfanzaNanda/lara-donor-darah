<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcaraToPengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->string('nama_acara',35)->nullable()->after('nama_tempat');
            $table->string('jumlah_peserta',10)->nullable()->after('nama_acara');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn('nama_acara');
            $table->dropColumn('jumlah_peserta');
        });
    }
}
