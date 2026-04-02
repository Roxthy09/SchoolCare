<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::statement("
            ALTER TABLE pengaduans 
            MODIFY status ENUM('tertunda','dalam_proses','selesai','dibatalkan') 
            DEFAULT 'tertunda'
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE pengaduans 
            MODIFY status ENUM('tertunda','dalam_proses','selesai') 
            DEFAULT 'tertunda'
        ");
    }
};