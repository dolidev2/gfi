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
        Schema::create('tissus', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('description')->nullable();
            $table->float('quantite')->nullable();
            $table->float('prix')->nullable();
            $table->float('commission')->nullable();
            $table->enum('statut',[env('STATUS_SUCCESS'), env('STATUS_FAILED')])->default(env('STATUS_FAILED'));
            $table->integer('client_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tissus');
    }
};
