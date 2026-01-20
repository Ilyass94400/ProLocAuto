<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('annonces', function (Blueprint $table) {
            // Par défaut, une annonce est "disponible" quand on la crée
            if (!Schema::hasColumn('annonces', 'statut')) {
                $table->string('statut')->default('disponible')->after('prix');
            }
        });
    }

    public function down()
    {
        Schema::table('annonces', function (Blueprint $table) {
            $table->dropColumn('statut');
        });
    }
};