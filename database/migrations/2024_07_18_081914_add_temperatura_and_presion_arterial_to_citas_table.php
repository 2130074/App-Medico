<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTemperaturaAndPresionArterialToCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->float('temperatura')->nullable()->after('total');
            $table->string('presion_arterial')->nullable()->after('temperatura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropColumn('temperatura');
            $table->dropColumn('presion_arterial');
        });
    }
}

