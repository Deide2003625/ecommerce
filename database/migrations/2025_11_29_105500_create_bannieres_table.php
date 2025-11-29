<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('bannieres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->string('sous_titre')->nullable();
            $table->string('lien')->nullable();
            $table->boolean('est_actif')->default(true);
            $table->integer('position')->default(0);
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('bannieres');
    }
};
