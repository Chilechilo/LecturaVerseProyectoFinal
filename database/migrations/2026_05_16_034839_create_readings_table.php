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
        Schema::create('readings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');

            $table->string('title');
            $table->string('author')->nullable();

            $table->enum('type', ['libro', 'comic', 'manga']);
            $table->enum('status', ['pendiente', 'leyendo', 'terminado', 'pausado', 'abandonado'])->default('pendiente');

            $table->integer('total_units')->default(1);
            $table->integer('current_unit')->default(0);

            $table->integer('rating')->nullable();
            $table->string('cover_url')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('readings');
    }
};
