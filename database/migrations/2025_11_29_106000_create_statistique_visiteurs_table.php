<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('statistique_visiteurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('adresse_ip');
            $table->timestamp('visite_le')->nullable();
            $table->string('agent_utilisateur')->nullable();
            $table->string('referent')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('statistique_visiteurs');
    }
};
