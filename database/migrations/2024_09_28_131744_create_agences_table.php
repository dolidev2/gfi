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
        Schema::create('agences', function (Blueprint $table) {
            $table->id();
            $table->string ('nom');
            $table->string ('contact')->nullable ();
            $table->string ('adresse')->nullable ();
            $table->string ('email')->nullable ();
            $table->string ('boite_postale')->nullable ();
            $table->string ('ifu')->nullable ();
            $table->string ('rccm')->nullable ();
            $table->string ('division_fiscale')->nullable ();
            $table->string ('regime_imposition')->nullable ();
            $table->enum ('status',['principale','annexe'])->default ('annexe');
            $table->string ('image')->nullable ();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agences');
    }
};
