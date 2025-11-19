<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->decimal('prix', 10, 2);
            $table->decimal('prix_promotionnel', 10, 2)->nullable();
            $table->string('reference')->unique();
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->boolean('en_vedette')->default(false);
            $table->boolean('actif')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Index pour les recherches fréquentes
            $table->index('nom');
            $table->index('reference');
            $table->index('actif');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
