<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dokters', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id_poli')->constrained('users');
        });
    }

    public function down()
    {
        Schema::table('dokters', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
