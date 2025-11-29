<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('commande_id');
            $table->unsignedBigInteger('livreur_id')->nullable();
            $table->string('numero_suivi')->nullable();
            $table->enum('statut', ['preparation', 'expediee', 'en_transit', 'livree'])->default('preparation');
            $table->date('date_estimee')->nullable();
            $table->timestamp('livree_le')->nullable();
            $table->timestamps();
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
            $table->foreign('livreur_id')->references('id')->on('livreurs')->onDelete('set null');
        });
    }
    public function down() {
        Schema::dropIfExists('livraisons');
    }
};
