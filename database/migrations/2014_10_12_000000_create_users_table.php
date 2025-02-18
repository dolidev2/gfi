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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet')->nullable ();
            $table->string('contact')->nullable ();
            $table->string('username')->unique ();
            $table->string('password')->unique ();
            $table->enum('role',['super_admin', 'admin','user'])->default ('admin');
            $table->enum('status',['active', 'inactive'])->default ('active');
            $table->string('cnib_recto')->nullable ();
            $table->string('cnib_verso')->nullable ();
            $table->string('image')->nullable ();
            $table->integer('agence_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
