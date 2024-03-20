<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEnumValuesInStatusFieldOfTicketsTable extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum('status', ['Aperto', 'In Lavorazione', 'Chiuso'])->change(); // Modifica i valori consentiti
        });
    }

    public function down()
    {
        // Se desideri eseguire un rollback della migrazione, aggiungi qui la logica per tornare allo stato precedente
    }
}
