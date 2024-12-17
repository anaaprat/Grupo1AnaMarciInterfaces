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
                $table->string('role')->default('User'); 
                $table->string('profile_picture')->nullable(); 
                $table->boolean('actived')->default(false); 
                $table->boolean('email_confirmed')->default(false); 
                $table->boolean('deleted')->default(false);
                $table->rememberToken();
                $table->timestamps(); 
            });
        }
    }


    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
