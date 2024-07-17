<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Menambahkan kolom driver_id dengan foreign key ke tabel drivers, nullable
            $table->foreignId('driver_id')->nullable()->constrained('drivers');

            // Menambahkan kolom approver_id dengan foreign key ke tabel users, nullable
            $table->foreignId('approver_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Menghapus foreign key constraint dan kolom driver_id
            $table->dropForeign(['driver_id']);
            $table->dropColumn('driver_id');

            // Menghapus foreign key constraint dan kolom approver_id
            $table->dropForeign(['approver_id']);
            $table->dropColumn('approver_id');
        });
    }
};
