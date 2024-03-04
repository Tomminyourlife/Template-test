<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPathToAttachmentsTable extends Migration
{
    public function up()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->string('path'); // Aggiungi questa riga per creare il campo 'path'
        });
    }

    public function down()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropColumn('path'); // Aggiungi questa riga se vuoi eseguire il rollback
        });
    }
}

