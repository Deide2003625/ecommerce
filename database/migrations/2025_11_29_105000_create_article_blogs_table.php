<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('article_blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('contenu');
            $table->text('extrait')->nullable();
            $table->boolean('est_actif')->default(true);
            $table->timestamp('publie_le')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('article_blogs');
    }
};
