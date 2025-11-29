<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->timestamp('inscrit_le')->nullable();
            $table->timestamp('desinscrit_le')->nullable();
        });
    }
    public function down() {
        Schema::dropIfExists('newsletters');
    }
};
