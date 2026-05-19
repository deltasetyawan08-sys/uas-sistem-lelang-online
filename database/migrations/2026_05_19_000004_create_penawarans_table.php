<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penawarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_lelang_id')->constrained('barang_lelangs')->cascadeOnDelete();
            $table->foreignId('peserta_lelang_id')->constrained('peserta_lelangs')->cascadeOnDelete();
            $table->decimal('nominal_bid', 15, 2);
            $table->dateTime('waktu_bid');
            $table->enum('status_bid', ['valid', 'tertinggi', 'kalah', 'dibatalkan'])->default('valid');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('penawarans'); }
};
