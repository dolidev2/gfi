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
        Schema::create('mesure_historiques', function (Blueprint $table) {
            $table->id();
            $table->string('epaule')->nullable()->size(100);
            $table->string('longueur_epaule')->nullable()->size(100);
            $table->string('longueur_manche')->nullable()->size(100);
            $table->string('bas')->nullable()->size(100);
            $table->string('poitrine')->nullable()->size(100);
            $table->string('dos')->nullable()->size(100);
            $table->string('bassin')->nullable()->size(100);
            $table->string('longueur_taille')->nullable()->size(100);
            $table->string('tour_genou')->nullable()->size(100);
            $table->string('ceinture')->nullable()->size(100);
            $table->string('poignet')->nullable()->size(100);
            $table->string('tour_taille')->nullable()->size(100);
            $table->string('tour_manche')->nullable()->size(100);
            $table->string('cole')->nullable()->size(100);
            $table->string('cuisse')->nullable()->size(100);
            $table->string('longueur_chemise')->nullable()->size(100);
            $table->string('longueur_gilet')->nullable()->size(100);
            $table->string('longueur_veste')->nullable()->size(100);
            $table->string('longueur_genou')->nullable()->size(100);
            $table->string('longueur_pantalon')->nullable()->size(100);
            $table->string('longueur_pantacourt')->nullable()->size(100);
            $table->string('entre_jambe')->nullable()->size(100);
            $table->string('longueur_chemise_arabe')->nullable()->size(100);
            $table->string('frappe')->nullable()->size(100);
            $table->string('carrure')->nullable()->size(100);
            $table->string('chapeau')->nullable()->size(100);
            $table->string('ecart_pince_poitrine')->nullable()->size(100);
            $table->string('longueur_jupe')->nullable()->size(100);
            $table->string('longueur_robe')->nullable()->size(100);
            $table->string('longueur_poitrine')->nullable()->size(100);
            $table->string('longueur_haut')->nullable()->size(100);
            $table->enum('sexe',['Masculin', 'Feminin'])->default('Masculin');
            $table->integer('client_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesure_historiques');
    }
};
