<?php

use Illuminate\Database\Migrations\Migration; // PERBAIKAN: Tambahkan spasi dan backslash
use Illuminate\Database\Schema\Blueprint;    // PERBAIKAN: Tambahkan spasi dan backslash
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom 'role', defaultnya adalah 'user'
            $table->string('role')->default('user')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom 'role' jika migrasi di-rollback
            $table->dropColumn('role');
        });
    }
};
