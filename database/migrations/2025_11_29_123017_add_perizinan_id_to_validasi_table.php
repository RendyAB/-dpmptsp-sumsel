<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('validasi', function (Blueprint $table) {

            // Cek dulu apakah kolom belum ada (biar tidak error saat migrate ulang)
            if (!Schema::hasColumn('validasi', 'perizinan_id')) {

                $table->unsignedBigInteger('perizinan_id')
                    ->nullable()
                    ->after('id');

                $table->foreign('perizinan_id')
                    ->references('id')
                    ->on('perizinan_2')
                    ->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('validasi', function (Blueprint $table) {

            if (Schema::hasColumn('validasi', 'perizinan_id')) {
                $table->dropForeign(['perizinan_id']);
                $table->dropColumn('perizinan_id');
            }

        });
    }
};
