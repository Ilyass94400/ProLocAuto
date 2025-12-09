<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            
            // 1. LE CLIENT (Liaison avec la table users)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // 2. L'ANNONCE (Liaison avec la table annonces)
            $table->foreignId('annonce_id')->constrained()->onDelete('cascade');

            // 3. LA DATE
            $table->date('date_debut'); // Le jour de la réservation
            
            $table->timestamps(); // Created_at et Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};