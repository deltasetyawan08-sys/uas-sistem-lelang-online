<?php

namespace App\Http\Controllers;

use App\Models\Panitia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PanitiaController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Panitia::latest()->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_panitia' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'jabatan' => 'required|string|max:100',
        ]);
        $panitia = Panitia::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Panitia berhasil ditambahkan.',
            'data' => $panitia
        ], 201);
    }

    public function show($id)
    {
        $panitia = Panitia::find($id);
        if (!$panitia) {
            return response()->json(['status' => 'error', 'message' => 'Panitia tidak ditemukan.'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $panitia], 200);
    }

    public function update(Request $request, $id)
    {
        $panitia = Panitia::find($id);
        if (!$panitia) {
            return response()->json(['status' => 'error', 'message' => 'Panitia tidak ditemukan.'], 404);
        }
        $validated = $request->validate([
            'nama_panitia' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'jabatan' => 'required|string|max:100',
        ]);
        $panitia->update($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Panitia berhasil diperbarui.',
            'data' => $panitia
        ], 200);
    }

    public function destroy($id)
    {
        $panitia = Panitia::find($id);
        if (!$panitia) {
            return response()->json(['status' => 'error', 'message' => 'Panitia tidak ditemukan.'], 404);
        }
        $panitia->delete();
        return response()->json(['status' => 'success', 'message' => 'Panitia berhasil dihapus.'], 200);
    }
}
