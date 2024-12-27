<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jadwal_periksas', function (Blueprint $table) {
            $table->enum('status', ['aktif', 'tidak aktif'])->default('aktif')->after('jam_selesai');
        });
    }

    public function down()
    {
        Schema::table('jadwal_periksas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
