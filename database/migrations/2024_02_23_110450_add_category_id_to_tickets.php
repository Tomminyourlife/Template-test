<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToTickets extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Aggiungi una colonna 'category_id'
            $table->unsignedBigInteger('category_id')->nullable();

            // Aggiungi la chiave esterna
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Rimuovi la chiave esterna se necessario
            $table->dropForeign(['category_id']);

            // Rimuovi la colonna 'category_id'
            $table->dropColumn('category_id');
        });
    }
}

