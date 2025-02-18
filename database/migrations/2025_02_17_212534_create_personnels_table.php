<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->string('contact');
            $table->string('adresse')->nullable();;
            $table->string('matricule');
            $table->string('image')->nullable();
            $table->string('cnib_recto')->nullable();
            $table->string('cnib_verso')->nullable();
            $table->integer('agence_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
