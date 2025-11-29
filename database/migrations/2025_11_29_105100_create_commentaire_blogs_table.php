<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('commentaire_blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_blog_id');
            $table->text('contenu');
            $table->boolean('est_approuve')->default(false);
            $table->timestamps();
            $table->foreign('article_blog_id')->references('id')->on('article_blogs')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('commentaire_blogs');
    }
};
