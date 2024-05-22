<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reward_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reward_id')->constrained()->onDelete('cascade');     // Recompensa entregada
            $table->foreignId('user_id')->constrained()->onDelete('cascade');       // Usuario q recibe la recompensa
            $table->decimal('amount', 8, 2);                                        // Cantidad de la contribución
            $table->timestamp('contribution_date');                                 // Fecha de la contribución
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('reward_user');
    }
}

