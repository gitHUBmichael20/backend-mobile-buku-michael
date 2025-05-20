<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $id_buku, $judul_buku, $deskripsi_buku, $penulis, $tahun_terbit, $sampul_buku;
    public function index(Request $request)
    {
        $buku = BukuModel::all();
        return response()->json($buku);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validasi input
        if (empty($request->judul_buku) || empty($request->penulis) || empty($request->tahun_terbit)) {
            return response()->json(['error' => 'Data tidak boleh kosong'], 400);
        }

        // Data yang disiapkan
        $data = [
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'deskripsi_buku' => $request->deskripsi_buku,
            'tahun_terbit' => $request->tahun_terbit,
            'sampul_buku' => $request->sampul_buku
        ];

        // Simpan data
        try {
            BukuModel::create($data);
            return response()->json(['success' => 'Data buku berhasil disimpan'], 201);
        } catch (\Exception $e) {
            error_log($e->getMessage()); // Ganti Log::error() ke sini
            return response()->json(['error' => 'Gagal menyimpan data buku'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $id_buku)
    {
        $buku = BukuModel::find($id_buku);
        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $buku->judul_buku = $request->input('judul_buku', $buku->judul_buku);
        $buku->penulis = $request->input('penulis', $buku->penulis);
        $buku->deskripsi_buku = $request->input('deskripsi_buku', $buku->deskripsi_buku);
        $buku->tahun_terbit = $request->input('tahun_terbit', $buku->tahun_terbit);
        $buku->sampul_buku = $request->input('sampul_buku', $buku->sampul_buku);

        $berhasil = $buku->save();

        if ($berhasil) {
            return response()->json([
                'status' => true,
                'message' => 'Data Buku Behasil Diubah',
                'data' => $buku
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data Buku Gagal Diubah',
                'data' => $buku
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id_buku)
    {
        // Check if book exists
        $buku = BukuModel::where('id_buku', $id_buku)->first();

        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        // Validate required fields
        if (empty($request->judul_buku) || empty($request->penulis) || empty($request->tahun_terbit)) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak boleh ada yang kosong'
            ], 422);
        }

        // Prepare data for update
        $data = [
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'deskripsi_buku' => $request->deskripsi_buku,
            'tahun_terbit' => $request->tahun_terbit,
            'sampul_buku' => $request->sampul_buku
        ];

        // Perform update
        $update = BukuModel::where('id_buku', $id_buku)->update($data);

        if ($update) {
            return response()->json([
                'success' => true,
                'message' => 'Data buku berhasil diubah',
                'data' => BukuModel::find($id_buku)
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data buku gagal diubah'
        ], 500);
    }

    public function bacaBuku(int $id_buku)
    {
        $buku = BukuModel::findOrFail($id_buku);
        return view('baca', compact('buku'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id_buku)
    {
        $buku = BukuModel::where('id_buku', $id_buku)->first();

        if (!$buku) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku tidak ditemukan',
                'details' => [
                    'id_buku' => $id_buku,
                    'error' => 'No book found with the provided ID',
                    'timestamp' => now()->toDateTimeString(),
                ]
            ], 404);
        }

        $buku->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil dihapus',
            'details' => [
                'id_buku' => $id_buku,
                'title' => $buku->judul, // Assuming 'judul' is the book title field
                'timestamp' => now()->toDateTimeString(),
            ]
        ], 200);
    }
}
