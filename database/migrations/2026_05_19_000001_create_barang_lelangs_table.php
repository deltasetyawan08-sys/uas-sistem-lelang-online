<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('barang_lelangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_awal', 15, 2);
            $table->enum('status', ['draft', 'aktif', 'selesai', 'dibatalkan'])->default('draft');
            $table->dateTime('tanggal_mulai')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('barang_lelangs'); }
};
