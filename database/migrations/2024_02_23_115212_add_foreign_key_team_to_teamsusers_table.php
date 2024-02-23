<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyTeamToTeamsusersTable extends Migration
{
    public function up()
    {
        Schema::table('teamsusers', function (Blueprint $table) {
            // Aggiungi la chiave esterna per il team
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    public function down()
    {
        Schema::table('teamsusers', function (Blueprint $table) {
            // Rimuovi la chiave esterna se necessario
            $table->dropForeign(['team_id']);
        });
    }
}
