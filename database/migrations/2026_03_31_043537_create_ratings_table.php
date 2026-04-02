<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id('rating_id');

            $table->unsignedBigInteger('pengaduan_id');
            $table->unsignedBigInteger('user_id');

            $table->integer('rating'); // 1 - 5
            $table->text('komentar')->nullable();

            $table->timestamps();

            $table->foreign('pengaduan_id')
                ->references('pengaduan_id')->on('pengaduans')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};