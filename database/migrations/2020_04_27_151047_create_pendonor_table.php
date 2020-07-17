<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendonor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('ktp', 35);
            $table->string('nama', 30);
            $table->string('kabupaten', 30)->nullable();
            $table->string('kecamatan', 30)->nullable();
            $table->string('desa', 30)->nullable();
            $table->text('alamat');
            $table->string('jenis_kelamin',10);
            $table->string('tempat_lahir',25);
            $table->string('tanggal_lahir',10);
            $table->string('pekerjaan',25);
            $table->string('nama_ibu',30);
            $table->string('status_nikah', 20);
            $table->string('phone', 30);
            $table->string('gol_dar', 2);
            $table->string('rhesus', 1);
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
        Schema::dropIfExists('pendonor');
    }
}
