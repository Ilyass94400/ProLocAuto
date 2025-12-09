<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            // Créera automatiquement sender_id (bigint) et sender_type (string)
            $table->morphs('sender'); 
            
            // Créera automatiquement receiver_id (bigint) et receiver_type (string)
            $table->morphs('receiver'); 
            
            $table->text('content');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
