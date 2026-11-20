<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_area_parkir', function (Blueprint $table) {
            $table->string('jenis_kendaraan', 20)->nullable();
        });
    }

    public function down(): void
    {
        // Tidak menghapus kolom agar data tetap aman.
    }
};