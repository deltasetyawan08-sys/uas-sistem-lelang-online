<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pemenangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_lelang_id')->constrained('barang_lelangs')->cascadeOnDelete();
            $table->foreignId('peserta_lelang_id')->constrained('peserta_lelangs')->cascadeOnDelete();
            $table->foreignId('penawaran_id')->constrained('penawarans')->cascadeOnDelete();
            $table->decimal('harga_menang', 15, 2);
            $table->date('tanggal_menang');
            $table->enum('status_pembayaran', ['belum_bayar', 'dp', 'lunas'])->default('belum_bayar');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pemenangs'); }
};
