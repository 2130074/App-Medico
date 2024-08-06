<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('motivos');
            $table->date('fecha');
            $table->time('hora');
            $table->string('estado')->nullable();  
            $table->unsignedBigInteger('id_paciente');  
            $table->unsignedBigInteger('id_servicio');  
            $table->json('medicamentos')->nullable();
            $table->string('estudios')->nullable();
            $table->json('productos')->nullable(); 
            $table->decimal('total', 8, 2)->default(0);
            $table->float('temperatura')->nullable();
            $table->string('presion_arterial')->nullable(); 
            $table->text('diagnostico')->nullable(); 
            $table->timestamps();

            // Definir las llaves foráneas
            $table->foreign('id_paciente')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('id_servicio')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
