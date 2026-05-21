<?php

namespace App\Http\Controllers;

use App\Models\PesertaLelang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Exception;

class PesertaLelangController extends Controller
{
    /**
     * Menampilkan seluruh peserta lelang
     */
    public function index()
    {
        try {
            $peserta = PesertaLelang::latest()->get();

            return response()->json([
                'success' => true,
                'message' => 'Data peserta lelang berhasil diambil.',
                'data' => $peserta
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menambahkan peserta lelang baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:peserta_lelangs,email',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'status_verifikasi' => [
                'required',
                Rule::in(['pending', 'terverifikasi', 'ditolak'])
            ],
        ]);

        try {
            $peserta = PesertaLelang::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Peserta lelang berhasil ditambahkan.',
                'data' => $peserta
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan peserta lelang.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan detail peserta lelang
     */
    public function show($id)
    {
        try {
            $peserta = PesertaLelang::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Detail peserta lelang berhasil diambil.',
                'data' => $peserta
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta lelang tidak ditemukan.'
            ], 404);
        }
    }

    /**
     * Memperbarui data peserta lelang
     */
    public function update(Request $request, $id)
    {
        try {
            $peserta = PesertaLelang::findOrFail($id);

            $validated = $request->validate([
                'nama_peserta' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('peserta_lelangs')->ignore($peserta->id),
                ],
                'no_hp' => 'required|string|max:20',
                'alamat' => 'nullable|string',
                'status_verifikasi' => [
                    'required',
                    Rule::in(['pending', 'terverifikasi', 'ditolak'])
                ],
            ]);

            $peserta->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Peserta lelang berhasil diperbarui.',
                'data' => $peserta
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data peserta lelang.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus peserta lelang
     */
    public function destroy($id)
    {
        try {
            $peserta = PesertaLelang::findOrFail($id);

            $peserta->delete();

            return response()->json([
                'success' => true,
                'message' => 'Peserta lelang berhasil dihapus.'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta lelang tidak ditemukan.'
            ], 404);
        }
    }
}