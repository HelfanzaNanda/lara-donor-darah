<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('darah_id')->nullable();
            $table->string('nama_pasien', 35);
            $table->string('jenis_kelamin', 35);
            $table->string('ruangan', 35);
            $table->string('diagnosa', 50);
            $table->integer('jumlah');
            $table->string('tempat', 35);
            $table->date('tanggal');
            $table->string('nama_dokter', 35);
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
        Schema::dropIfExists('permintaan');
    }
}
