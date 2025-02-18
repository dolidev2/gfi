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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string ('matricule');
            $table->string ('nom_complet')->nullable ();
            $table->string ('contact')->nullable ();
            $table->string ('adresse')->nullable ();
            $table->string ('image')->nullable ();
            $table->enum ('statut_juridique',['physique', 'moral','revendeur'])->default ('physique');
            $table->string ('boite_postale')->nullable ();
            $table->string ('ifu')->nullable ();
            $table->string ('rccm')->nullable ();
            $table->string ('divsion_fiscale')->nullable ();
            $table->string ('regime_imposition')->nullable ();
            $table->string ('client')->default (0);
            $table->integer ('agence_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
