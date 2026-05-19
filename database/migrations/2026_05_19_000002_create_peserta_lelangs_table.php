<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('peserta_lelangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peserta');
            $table->string('email')->unique();
            $table->string('no_hp', 20);
            $table->text('alamat')->nullable();
            $table->enum('status_verifikasi', ['pending', 'terverifikasi', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('peserta_lelangs'); }
};
