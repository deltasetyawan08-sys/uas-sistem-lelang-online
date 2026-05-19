<?php

namespace App\Http\Controllers;

use App\Models\PesertaLelang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PesertaLelangController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => PesertaLelang::latest()->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'status_verifikasi' => 'required|in:pending,terverifikasi,ditolak',
        ]);
        $peserta = PesertaLelang::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Peserta lelang berhasil ditambahkan.',
            'data' => $peserta
        ], 201);
    }

    public function show($id)
    {
        $peserta = PesertaLelang::find($id);
        if (!$peserta) {
            return response()->json(['status' => 'error', 'message' => 'Peserta lelang tidak ditemukan.'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $peserta], 200);
    }

    public function update(Request $request, $id)
    {
        $peserta = PesertaLelang::find($id);
        if (!$peserta) {
            return response()->json(['status' => 'error', 'message' => 'Peserta lelang tidak ditemukan.'], 404);
        }
        $validated = $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'status_verifikasi' => 'required|in:pending,terverifikasi,ditolak',
        ]);
        $peserta->update($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Peserta lelang berhasil diperbarui.',
            'data' => $peserta
        ], 200);
    }

    public function destroy($id)
    {
        $peserta = PesertaLelang::find($id);
        if (!$peserta) {
            return response()->json(['status' => 'error', 'message' => 'Peserta lelang tidak ditemukan.'], 404);
        }
        $peserta->delete();
        return response()->json(['status' => 'success', 'message' => 'Peserta lelang berhasil dihapus.'], 200);
    }
}
