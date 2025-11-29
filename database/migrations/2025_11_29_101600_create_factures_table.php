<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('factures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('commande_id');
            $table->string('numero')->unique();
            $table->decimal('montant', 10, 2);
            $table->decimal('montant_taxe', 10, 2)->nullable();
            $table->date('date_echeance')->nullable();
            $table->timestamp('payee_le')->nullable();
            $table->timestamps();
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('factures');
    }
};
