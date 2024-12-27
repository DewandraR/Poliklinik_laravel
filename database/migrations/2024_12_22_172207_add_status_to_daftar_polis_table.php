<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('daftar_polis', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'diperiksa', 'selesai'])->default('menunggu')->after('no_antrian');
        });
    }

    public function down()
    {
        Schema::table('daftar_polis', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
