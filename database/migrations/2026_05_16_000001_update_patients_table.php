<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Tambah kolom yang belum ada
            if (!Schema::hasColumn('patients', 'tglLahir')) {
                $table->date('tglLahir')->nullable()->after('nik');
            }
            if (!Schema::hasColumn('patients', 'noHp')) {
                // rename hp → noHp jika hp masih ada
                if (Schema::hasColumn('patients', 'hp')) {
                    $table->renameColumn('hp', 'noHp');
                } else {
                    $table->string('noHp')->nullable()->after('tglLahir');
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            if (Schema::hasColumn('patients', 'tglLahir')) {
                $table->dropColumn('tglLahir');
            }
            if (Schema::hasColumn('patients', 'noHp')) {
                $table->renameColumn('noHp', 'hp');
            }
        });
    }
};
