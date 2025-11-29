<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('commandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('utilisateur_id');
            $table->enum('statut', ['en_attente', 'validee', 'annulee'])->default('en_attente');
            $table->decimal('prix_total', 10, 2);
            $table->decimal('sous_total', 10, 2);
            $table->decimal('montant_taxe', 10, 2)->nullable();
            $table->decimal('frais_livraison', 10, 2)->nullable();
            $table->enum('statut_paiement', ['en_attente', 'paye', 'echoue'])->default('en_attente');
            $table->string('methode_paiement')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('commandes');
    }
};
