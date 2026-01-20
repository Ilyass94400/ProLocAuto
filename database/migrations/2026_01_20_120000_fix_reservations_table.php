<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            
            
            if (!Schema::hasColumn('reservations', 'duree')) {
                $table->string('duree')->nullable()->after('annonce_id');
            }
            
            if (!Schema::hasColumn('reservations', 'date_debut')) {
                $table->date('date_debut')->nullable()->after('duree');
            }
            
            if (!Schema::hasColumn('reservations', 'prix')) {
                $table->decimal('prix', 10, 2)->default(0)->after('date_debut');
            }
            
            if (!Schema::hasColumn('reservations', 'statut')) {
                $table->string('statut')->default('Confirmée')->after('prix');
            }
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['duree', 'date_debut', 'prix', 'statut']);
        });
    }
};