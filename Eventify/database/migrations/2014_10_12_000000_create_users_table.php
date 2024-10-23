<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('role')->default('User'); // Rol de usuario por defecto
                $table->string('profile_picture')->nullable(); // Campo para imagen de perfil
                $table->boolean('actived')->default(false); // Si está activado por el administrador
                $table->boolean('email_confirmed')->default(false); // Confirmación del email
                $table->boolean('deleted')->default(false); // Soft delete
                $table->rememberToken();
                $table->timestamps(); // Campos created_at y updated_at
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
