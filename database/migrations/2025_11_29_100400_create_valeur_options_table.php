<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('valeur_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('valeur');
            $table->string('code_couleur')->nullable();
            $table->string('image')->nullable();
            $table->integer('ordre_affichage')->default(0);
            $table->unsignedBigInteger('option_produit_id');
            $table->timestamps();
            $table->foreign('option_produit_id')->references('id')->on('option_produits')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('valeur_options');
    }
};
