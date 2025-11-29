<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('rapport_ventes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('total_commandes')->default(0);
            $table->decimal('total_ventes', 10, 2)->default(0);
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('rapport_ventes');
    }
};
