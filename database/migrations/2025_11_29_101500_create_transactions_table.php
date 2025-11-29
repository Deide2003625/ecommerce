<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('commande_id');
            $table->decimal('montant', 10, 2);
            $table->enum('statut', ['en_attente', 'completee', 'echouee', 'remboursee'])->default('en_attente');
            $table->string('passerelle')->nullable();
            $table->string('reference')->nullable();
            $table->text('reponse_passerelle')->nullable();
            $table->timestamp('traite_le')->nullable();
            $table->timestamps();
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('transactions');
    }
};
