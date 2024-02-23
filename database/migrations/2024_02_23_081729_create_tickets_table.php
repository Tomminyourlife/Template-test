<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Chiave esterna per l'utente associato al ticket
            $table->string('title');
            $table->text('description');
            //$table->foreignId('category_id')->nullable()->constrained('categories'); // Chiave esterna per la categoria del ticket
            //$table->foreignId('attachment_id')->nullable()->constrained('attachments'); // Chiave esterna per l'allegato del ticket
            $table->enum('status', ['aperto', 'in_corso', 'chiuso'])->default('aperto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
