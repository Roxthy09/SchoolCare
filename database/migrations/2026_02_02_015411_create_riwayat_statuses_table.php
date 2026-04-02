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
        Schema::create('riwayat_statuses', function (Blueprint $table) {
            $table->id('riwayat_id');

            $table->foreignId('pengaduan_id')
                ->constrained('pengaduans', 'pengaduan_id')
                ->cascadeOnDelete();

            $table->string('status');
            $table->timestamp('tanggal_ubah')->useCurrent();

            $table->foreignId('diubah_oleh')
                ->constrained('users', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_statuses');
    }
};
