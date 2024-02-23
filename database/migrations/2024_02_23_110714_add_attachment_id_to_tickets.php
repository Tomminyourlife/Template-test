<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttachmentIdToTickets extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Aggiungi una colonna 'attachment_id'
            $table->unsignedBigInteger('attachment_id')->nullable();

            // Aggiungi la chiave esterna
            $table->foreign('attachment_id')->references('id')->on('attachments');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Rimuovi la chiave esterna se necessario
            $table->dropForeign(['attachment_id']);

            // Rimuovi la colonna 'attachment_id'
            $table->dropColumn('attachment_id');
        });
    }
}
