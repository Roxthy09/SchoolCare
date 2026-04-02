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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id('notifikasi_id');

            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->cascadeOnDelete();

            $table->foreignId('pengaduan_id')
                ->constrained('pengaduans', 'pengaduan_id')
                ->cascadeOnDelete();

            $table->string('pesan');
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamp('tanggal_dikirim')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
