<?php

namespace App\Http\Controllers;

use App\Models\BarangLelang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BarangLelangController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => BarangLelang::latest()->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_awal' => 'required|numeric|min:0',
            'status' => 'required|in:draft,aktif,selesai,dibatalkan',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $barang = BarangLelang::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Barang lelang berhasil ditambahkan.',
            'data' => $barang
        ], 201);
    }

    public function show($id)
    {
        $barang = BarangLelang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Barang lelang tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $barang
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $barang = BarangLelang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Barang lelang tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_awal' => 'required|numeric|min:0',
            'status' => 'required|in:draft,aktif,selesai,dibatalkan',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $barang->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Barang lelang berhasil diperbarui.',
            'data' => $barang
        ], 200);
    }

    public function destroy($id)
    {
        $barang = BarangLelang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Barang lelang tidak ditemukan.'
            ], 404);
        }

        $barang->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Barang lelang berhasil dihapus.'
        ], 200);
    }
}