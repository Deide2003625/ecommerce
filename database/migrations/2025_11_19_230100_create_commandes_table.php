<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('livreur_id')->nullable()->constrained('users')->onDelete('set null');
            $table->dateTime('date_livraison')->nullable();
            $table->enum('statut', ['en_attente', 'en_preparation', 'expediee', 'livree', 'annulee'])->default('en_attente');
            $table->decimal('total', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Index pour les recherches fréquentes
            $table->index('statut');
            $table->index('date_livraison');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
