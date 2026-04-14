<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("
        ALTER TABLE pengaduans 
        MODIFY status ENUM('tertunda','dalam_proses','selesai','dibatalkan','ditolak') 
        DEFAULT 'tertunda'
    ");

        Schema::table('pengaduans', function (Blueprint $table) {
            $table->text('alasan_ditolak')->nullable();
        });
    }

    public function down()
    {
        DB::statement("
        ALTER TABLE pengaduans 
        MODIFY status ENUM('tertunda','dalam_proses','dibatalkan','selesai') 
        DEFAULT 'tertunda'
    ");

        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn('alasan_ditolak');
        });
    }
};
