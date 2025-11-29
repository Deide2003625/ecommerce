<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('option_produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->enum('type', ['liste', 'couleur', 'taille', 'capacite', 'memoire']);
            $table->boolean('est_obligatoire')->default(false);
            $table->integer('ordre_affichage')->default(0);
            $table->unsignedBigInteger('produit_id');
            $table->timestamps();
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('option_produits');
    }
};
