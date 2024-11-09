<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('events')) { // Cambia aquí la verificación de la tabla
            Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->foreignId('organized_id')->constrained('users')->onDelete('cascade');
                $table->string('title');
                $table->text('description');
                $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
                $table->dateTime('start_time');
                $table->dateTime('end_time');
                $table->string('location');
                $table->decimal('latitude', 10, 7)->nullable();
                $table->decimal('longitude', 10, 7)->nullable();
                $table->integer('max_attendees');
                $table->decimal('price', 8, 2);
                $table->string('image_url')->nullable();
                $table->boolean('deleted')->default(false);
                $table->timestamps();
            });
        }
    }


    /**
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
