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
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->float('montant');
            $table->string('numero_caisse');
            $table->string('motif');
            $table->enum('mode_caisse',[env('TYPE_CAISSE_ENTRE'), env('TYPE_CAISSE_SORTIE')])->default(env('TYPE_CAISSE_ENTRE'));
            $table->integer('agence_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caisses');
    }
};
