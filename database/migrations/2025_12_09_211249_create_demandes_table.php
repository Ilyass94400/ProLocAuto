<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Qui demande ?
            $table->string('nom_client');
            $table->foreignId('annonce_id')->constrained()->onDelete('cascade'); // Quelle annonce ?
            $table->string('titre_annonce');
            $table->string('duree');       // 1 mois, 6 mois...
            $table->date('date_debut');    // Quand ça commence
            $table->text('message')->nullable();
            $table->string('statut')->default('En attente'); // Validée/Refusée
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demandes');
    }
};