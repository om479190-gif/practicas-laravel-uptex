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
    // Crear tabla roles 
    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // admin, editor, viewer 
        $table->timestamps(); // Esto genera created_at y updated_at 
    });

    // Crear tabla user_roles (tabla pivote) [cite: 22]
    Schema::create('user_roles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario [cite: 22]
        $table->foreignId('role_id')->constrained()->onDelete('cascade'); // Relación con el rol [cite: 22]
        $table->timestamps(); // Esto genera created_at y updated_at [cite: 22]
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
