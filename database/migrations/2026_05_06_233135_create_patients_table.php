<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 16)->unique();
            $table->string('hp');
            $table->text('alamat');
            $table->string('dusun');
            $table->string('kecamatan');
            $table->enum('kategori', ['ibu', 'balita', 'lansia'])->nullable();
            $table->integer('anakKe')->default(1);
            $table->date('tglKunjungan')->nullable();
            $table->integer('usiaHamil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
