<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('clients', function (Blueprint $table) {
        $table->id();                     // Crée la colonne 'id'
        $table->string('nom');            // Crée la colonne 'nom'
        $table->string('prenom');         // Crée la colonne 'prenom'
        $table->string('nomentreprise');  // Crée la colonne 'nomentreprise'
        $table->string('telephone');      // Crée la colonne 'telephone'
        $table->timestamps();             // Crée 'created_at' et 'updated_at'
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
