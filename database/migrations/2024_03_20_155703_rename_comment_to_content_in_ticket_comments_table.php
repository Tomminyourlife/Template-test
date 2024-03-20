<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ticket_comments', function (Blueprint $table) {
            // Rinomina il campo comment in content
            DB::statement('ALTER TABLE ticket_comments CHANGE comment content TEXT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_comments', function (Blueprint $table) {
            // Puoi implementare la migrazione inversa se necessario
            // Ad esempio, rinominare il campo da content a comment
            DB::statement('ALTER TABLE ticket_comments CHANGE content comment TEXT');
        });
    }
};
