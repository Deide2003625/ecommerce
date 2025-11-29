<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('email');
            $table->string('sujet');
            $table->text('message');
            $table->boolean('statut_reponse')->default(false);
            $table->text('message_reponse')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('contacts');
    }
};
