<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            // Le lien avec le client destinataire (clé étrangère vers la table users)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('sujet');
            $table->text('message');
            $table->boolean('lu')->default(false); // Pour savoir si le client l'a lu
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};