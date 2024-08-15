<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->constrained()->onDelete('cascade'); // ID del mensaje original (notificación)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID del usuario que responde (Doctor)
            $table->text('message'); // El texto de la respuesta
            $table->timestamps(); // Timestamps para la respuesta
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
