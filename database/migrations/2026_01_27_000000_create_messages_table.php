<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // CORRECTIF : On supprime la table si elle existe déjà pour éviter l'erreur "Table already exists"
        Schema::dropIfExists('messages');

        // Ensuite, on la crée proprement
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject'); // Le sujet du message
            $table->text('message');   // Le contenu
            $table->boolean('lu')->default(false); // Pour savoir si le commercial l'a lu
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};