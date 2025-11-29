<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('prix_base', 10, 2);
            $table->decimal('prix_comparatif', 10, 2)->nullable();
            $table->integer('stock_total')->default(0);
            $table->string('sku')->nullable();
            $table->string('code_barre')->nullable();
            $table->boolean('est_actif')->default(true);
            $table->boolean('est_en_vedette')->default(false);
            $table->boolean('a_des_variantes')->default(false);
            $table->unsignedBigInteger('sous_categorie_id')->nullable();
            $table->timestamps();
            $table->foreign('sous_categorie_id')->references('id')->on('sous_categories')->onDelete('set null');
        });
    }
    public function down() {
        Schema::dropIfExists('produits');
    }
};
