<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('variante_produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku')->nullable();
            $table->decimal('prix', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->boolean('est_actif')->default(true);
            $table->json('combinaison_options');
            $table->unsignedBigInteger('produit_id');
            $table->timestamps();
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('variante_produits');
    }
};
