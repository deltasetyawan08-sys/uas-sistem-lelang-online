<?php

namespace App\Http\Controllers;

use App\Models\Pemenang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PemenangController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Pemenang::with(['barangLelang','pesertaLelang','penawaran'])->latest()->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_lelang_id' => 'required|exists:barang_lelangs,id',
            'peserta_lelang_id' => 'required|exists:peserta_lelangs,id',
            'penawaran_id' => 'required|exists:penawarans,id',
            'harga_menang' => 'required|numeric|min:1',
            'tanggal_menang' => 'required|date',
            'status_pembayaran' => 'required|in:belum_bayar,dp,lunas',
        ]);
        $pemenang = Pemenang::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Pemenang berhasil ditambahkan.',
            'data' => $pemenang
        ], 201);
    }

    public function show($id)
    {
        $pemenang = Pemenang::with(['barangLelang','pesertaLelang','penawaran'])->find($id);
        if (!$pemenang) {
            return response()->json(['status' => 'error', 'message' => 'Pemenang tidak ditemukan.'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $pemenang], 200);
    }

    public function update(Request $request, $id)
    {
        $pemenang = Pemenang::find($id);
        if (!$pemenang) {
            return response()->json(['status' => 'error', 'message' => 'Pemenang tidak ditemukan.'], 404);
        }
        $validated = $request->validate([
            'barang_lelang_id' => 'required|exists:barang_lelangs,id',
            'peserta_lelang_id' => 'required|exists:peserta_lelangs,id',
            'penawaran_id' => 'required|exists:penawarans,id',
            'harga_menang' => 'required|numeric|min:1',
            'tanggal_menang' => 'required|date',
            'status_pembayaran' => 'required|in:belum_bayar,dp,lunas',
        ]);
        $pemenang->update($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Pemenang berhasil diperbarui.',
            'data' => $pemenang
        ], 200);
    }

    public function destroy($id)
    {
        $pemenang = Pemenang::find($id);
        if (!$pemenang) {
            return response()->json(['status' => 'error', 'message' => 'Pemenang tidak ditemukan.'], 404);
        }
        $pemenang->delete();
        return response()->json(['status' => 'success', 'message' => 'Pemenang berhasil dihapus.'], 200);
    }
}
