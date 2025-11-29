<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('methodes_paiement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->text('description')->nullable();
            $table->boolean('est_actif')->default(true);
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('methodes_paiement');
    }
};
