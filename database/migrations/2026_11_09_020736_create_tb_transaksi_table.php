<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id('id_parkir');
            $table->unsignedBigInteger('id_kendaraan');
            $table->datetime('waktu_masuk');
            $table->datetime('waktu_keluar')->nullable;
            $table->unsignedBigInteger('id_tarif');
            $table->integer('durasi_jam')->nullable;
            $table->decimal('biaya_total')->nullable;
            $table->enum('status', ['masuk', 'keluar'])->default('masuk');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_area');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};