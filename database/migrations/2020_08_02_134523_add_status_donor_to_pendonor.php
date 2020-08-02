<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusDonorToPendonor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendonor', function (Blueprint $table) {
            $table->string('status_donor',20)->nullable()->after('rhesus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendonor', function (Blueprint $table) {
            $table->dropColumn('status_donor');
        });
    }
}
