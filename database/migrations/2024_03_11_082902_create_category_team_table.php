<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTeamTable extends Migration
{
    public function up()
    {
        Schema::create('category_team', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('team_id');
            $table->timestamps();

            // Definisci le chiavi esterne
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_team');
    }
}
