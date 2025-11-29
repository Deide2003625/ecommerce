<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('adresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('utilisateur_id');
            $table->string('libelle');
            $table->text('adresse');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('pays');
            $table->boolean('est_par_defaut')->default(false);
            $table->timestamps();
            $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('adresses');
    }
};
