<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyUserToTeamsusersTable extends Migration
{
    public function up()
    {
        Schema::table('teamsusers', function (Blueprint $table) {
            // Aggiungi la chiave esterna per l'utente
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('teamsusers', function (Blueprint $table) {
            // Rimuovi la chiave esterna se necessario
            $table->dropForeign(['user_id']);
        });
    }
}

