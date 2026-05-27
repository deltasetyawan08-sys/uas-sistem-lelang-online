<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Pemenang;
use App\Models\Penawaran;
use App\Models\BarangLelang;
use Illuminate\Http\Request;

class PemenangController extends Controller
{
    /**
     * GET /api/pemenang
     * Ambil semua data pemenang beserta relasi barang, peserta, penawaran
     */
    public function index()
    {
        $data = Pemenang::with([
            'barangLelang',
            'pesertaLelang',
            'penawaran'
        ])->latest()->get();

        return response()->json([
            'status' => 'success',
            'data'   => $data
        ], 200);
    }

    /**
     * POST /api/pemenang
     * Tambah pemenang secara manual
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_lelang_id'  => 'required|exists:barang_lelangs,id',
            'peserta_lelang_id' => 'required|exists:peserta_lelangs,id',
            'penawaran_id'      => 'required|exists:penawarans,id',
            'harga_menang'      => 'required|numeric|min:1',
            'tanggal_menang'    => 'required|date',
            'status_pembayaran' => 'required|in:belum_bayar,dp,lunas',
        ]);

        // Cegah duplikat pemenang untuk barang yang sama
        $sudahAda = Pemenang::where('barang_lelang_id', $validated['barang_lelang_id'])->first();
        if ($sudahAda) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Barang ini sudah memiliki pemenang.'
            ], 422);
        }

        $pemenang = Pemenang::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pemenang berhasil ditambahkan.',
            'data'    => $pemenang->load(['barangLelang', 'pesertaLelang', 'penawaran'])
        ], 201);
    }

    /**
     * GET /api/pemenang/{id}
     * Detail satu pemenang
     */
    public function show($id)
    {
        $pemenang = Pemenang::with(['barangLelang', 'pesertaLelang', 'penawaran'])->find($id);

        if (!$pemenang) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pemenang tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $pemenang
        ], 200);
    }

    /**
     * PUT /api/pemenang/{id}
     * Update data pemenang (terutama status pembayaran)
     */
    public function update(Request $request, $id)
    {
        $pemenang = Pemenang::find($id);

        if (!$pemenang) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pemenang tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'barang_lelang_id'  => 'required|exists:barang_lelangs,id',
            'peserta_lelang_id' => 'required|exists:peserta_lelangs,id',
            'penawaran_id'      => 'required|exists:penawarans,id',
            'harga_menang'      => 'required|numeric|min:1',
            'tanggal_menang'    => 'required|date',
            'status_pembayaran' => 'required|in:belum_bayar,dp,lunas',
        ]);

        $pemenang->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data pemenang berhasil diperbarui.',
            'data'    => $pemenang->load(['barangLelang', 'pesertaLelang', 'penawaran'])
        ], 200);
    }

    /**
     * DELETE /api/pemenang/{id}
     * Hapus data pemenang
     */
    public function destroy($id)
    {
        $pemenang = Pemenang::find($id);

        if (!$pemenang) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pemenang tidak ditemukan.'
            ], 404);
        }

        $pemenang->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data pemenang berhasil dihapus.'
        ], 200);
    }

    /**
     * POST /api/pemenang/tetapkan-otomatis
     * Tetapkan pemenang otomatis dari penawaran tertinggi suatu barang lelang
     */
    public function tetapkanOtomatis(Request $request)
    {
        $request->validate([
            'barang_lelang_id' => 'required|exists:barang_lelangs,id',
        ]);

        $barangId = $request->barang_lelang_id;

        // Cek apakah sudah ada pemenang untuk barang ini
        $sudahAda = Pemenang::where('barang_lelang_id', $barangId)->first();
        if ($sudahAda) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Barang ini sudah memiliki pemenang yang ditetapkan.'
            ], 422);
        }

        // Ambil penawaran tertinggi untuk barang ini
        $penawaranTertinggi = Penawaran::where('barang_lelang_id', $barangId)
            ->orderByDesc('nominal_bid')
            ->first();

        if (!$penawaranTertinggi) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Belum ada penawaran untuk barang ini.'
            ], 422);
        }

        // Update status barang menjadi selesai
        BarangLelang::where('id', $barangId)->update(['status' => 'selesai']);

        // Buat record pemenang
        $pemenang = Pemenang::create([
            'barang_lelang_id'  => $barangId,
            'peserta_lelang_id' => $penawaranTertinggi->peserta_lelang_id,
            'penawaran_id'      => $penawaranTertinggi->id,
            'harga_menang'      => $penawaranTertinggi->nominal_bid,
            'tanggal_menang'    => now()->toDateString(),
            'status_pembayaran' => 'belum_bayar',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pemenang berhasil ditetapkan secara otomatis.',
            'data'    => $pemenang->load(['barangLelang', 'pesertaLelang', 'penawaran'])
        ], 201);
    }
}