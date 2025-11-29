<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('utilisation_coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('utilisateur_id');
            $table->timestamp('utilise_le')->nullable();
            $table->timestamps();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('utilisation_coupons');
    }
};
