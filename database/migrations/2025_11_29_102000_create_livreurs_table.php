<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('livreurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->enum('statut', ['disponible', 'assigne', 'indisponible'])->default('disponible');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('livreurs');
    }
};
