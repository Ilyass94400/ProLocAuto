<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. On supprime la table existante qui pose problème
        Schema::dropIfExists('demandes');

        // 2. On la recrée proprement avec toutes les colonnes nécessaires
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            
            // Les colonnes manquantes qui causaient l'erreur
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nom_client');
            $table->foreignId('annonce_id')->constrained()->onDelete('cascade');
            $table->string('titre_annonce');
            
            // Les détails de la réservation
            $table->string('duree');
            $table->date('date_debut');
            $table->text('message')->nullable();
            
            $table->string('statut')->default('En attente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demandes');
    }
};