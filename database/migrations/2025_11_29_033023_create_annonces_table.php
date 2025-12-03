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
    Schema::create('annonces', function (Blueprint $table) {
        $table->id();                  // L'identifiant unique
        $table->string('titre');       // Titre de l'annonce
        $table->text('description');   // Description
        $table->decimal('prix', 8, 2); // Prix (ex: 150.00)
        $table->string('type');        // IMPORTANT : Type 1, Type 2 ou Type 3
        $table->timestamps();          // Date de création et modif
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
