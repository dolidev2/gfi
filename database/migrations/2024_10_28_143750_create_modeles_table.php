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
        Schema::create('modeles', function (Blueprint $table) {
            $table->id();
            $table->string ('nom');
            $table->string ('description')->nullable();
            $table->float ('prix');
            $table->float ('cout_montage');
            $table->float ('cout_decoupage');
            $table->enum ('statut',[env('MODELE_SIMPLE'), env('MODELE_COMPLEXE')])->default(env('MODELE_SIMPLE'));
            $table->json ('images')->nullable();
            $table->json ('modeles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modeles');
    }
};
