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
        Schema::create('commande_modele_tissus', function (Blueprint $table) {
            $table->id();
            $table->float('remise')->nullable();
            $table->integer('quantite')->nullable();
            $table->enum('statut',[env('STATUS_SUCCESS'), env('STATUS_FAILED')])->default(env('STATUS_FAILED'));
            $table->integer('commande_id');
            $table->integer('modele_id');
            $table->integer('tissu_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_modele_tissus');
    }
};
