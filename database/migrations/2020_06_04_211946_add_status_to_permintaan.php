<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPermintaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permintaan', function (Blueprint $table) {
            $table->string('status_permintaan', 10)->after('nama_dokter');
            $table->string('status_pembayaran',20)->nullable();
            $table->string('status_pengiriman',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permintaan', function (Blueprint $table) {
            $table->dropColumn('status_permintaan');
            $table->dropColumn('status_pembayaran');
            $table->dropColumn('status_pengiriman');
        });
    }
}
