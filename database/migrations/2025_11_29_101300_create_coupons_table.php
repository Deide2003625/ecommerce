<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->enum('type_reduction', ['pourcentage', 'fixe']);
            $table->decimal('valeur_reduction', 10, 2);
            $table->decimal('commande_minimum', 10, 2)->nullable();
            $table->dateTime('date_debut')->nullable();
            $table->dateTime('date_fin')->nullable();
            $table->integer('limite_utilisation')->nullable();
            $table->integer('compteur_utilisation')->default(0);
            $table->boolean('est_actif')->default(true);
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('coupons');
    }
};
