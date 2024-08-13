<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->unsignedBigInteger('enfermera_id')->nullable();

            $table->foreign('enfermera_id')->references('id')->on('enfermeras')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['enfermera_id']);
            $table->dropColumn('enfermera_id');
        });
    }
};
