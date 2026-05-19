<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenawaranController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Penawaran::with(['barangLelang','pesertaLelang'])->latest()->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_lelang_id' => 'required|exists:barang_lelangs,id',
            'peserta_lelang_id' => 'required|exists:peserta_lelangs,id',
            'nominal_bid' => 'required|numeric|min:1',
            'waktu_bid' => 'required|date',
            'status_bid' => 'required|in:valid,tertinggi,kalah,dibatalkan',
        ]);
        $penawaran = Penawaran::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Penawaran berhasil ditambahkan.',
            'data' => $penawaran
        ], 201);
    }

    public function show($id)
    {
        $penawaran = Penawaran::with(['barangLelang','pesertaLelang'])->find($id);
        if (!$penawaran) {
            return response()->json(['status' => 'error', 'message' => 'Penawaran tidak ditemukan.'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $penawaran], 200);
    }

    public function update(Request $request, $id)
    {
        $penawaran = Penawaran::find($id);
        if (!$penawaran) {
            return response()->json(['status' => 'error', 'message' => 'Penawaran tidak ditemukan.'], 404);
        }
        $validated = $request->validate([
            'barang_lelang_id' => 'required|exists:barang_lelangs,id',
            'peserta_lelang_id' => 'required|exists:peserta_lelangs,id',
            'nominal_bid' => 'required|numeric|min:1',
            'waktu_bid' => 'required|date',
            'status_bid' => 'required|in:valid,tertinggi,kalah,dibatalkan',
        ]);
        $penawaran->update($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Penawaran berhasil diperbarui.',
            'data' => $penawaran
        ], 200);
    }

    public function destroy($id)
    {
        $penawaran = Penawaran::find($id);
        if (!$penawaran) {
            return response()->json(['status' => 'error', 'message' => 'Penawaran tidak ditemukan.'], 404);
        }
        $penawaran->delete();
        return response()->json(['status' => 'success', 'message' => 'Penawaran berhasil dihapus.'], 200);
    }
}
