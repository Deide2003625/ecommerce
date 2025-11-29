<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('selection_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_commande_id');
            $table->string('nom_option');
            $table->string('valeur_option');
            $table->timestamps();
            $table->foreign('article_commande_id')->references('id')->on('article_commandes')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('selection_options');
    }
};
