<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeamIdToCategories extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Aggiungi una colonna 'team_id'
            $table->unsignedBigInteger('team_id')->nullable();

            // Aggiungi la chiave esterna
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Rimuovi la chiave esterna se necessario
            $table->dropForeign(['team_id']);

            // Rimuovi la colonna 'team_id'
            $table->dropColumn('team_id');
        });
    }
}

