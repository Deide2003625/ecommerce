<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('avis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('utilisateur_id');
            $table->unsignedBigInteger('produit_id');
            $table->integer('note');
            $table->text('commentaire')->nullable();
            $table->boolean('est_actif')->default(true);
            $table->timestamps();
            $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('avis');
    }
};
