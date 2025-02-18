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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->string ('numero_paiement');
            $table->float ('montant');
            $table->enum ('mode_paiement',[env('MODE_PAIEMENT_ESPECE'),
                env('MODE_PAIEMENT_CHEQUES'),
                env('MODE_PAIEMENT_MOBILE_MONEY'),
                env('MODE_PAIEMENT_VIREMENT')])->default(env('MODE_PAIEMENT_ESPECE'));
            $table->string('description')->nullable();
            $table->integer ('commande_id');
            $table->integer ('caisse_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
