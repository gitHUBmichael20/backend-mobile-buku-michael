<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $id_buku, $judul_buku, $deskripsi_buku, $penulis, $tahun_terbit;
    public function index(Request $request)
    {
        $buku = BukuModel::all();
        return view('index', ['buku' => $buku]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate required fields
        if (empty($request->judul_buku) || empty($request->penulis) || empty($request->tahun_terbit)) {
            return redirect()->route('buku.index')->with('error', 'Data tidak boleh ada yang kosong');
        }

        // Prepare data
        $data = [
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'deskripsi_buku' => $request->deskripsi_buku,
            'tahun_terbit' => $request->tahun_terbit
        ];

        // Create book
        try {
            BukuModel::create($data);
            return redirect()->route('buku.index')->with('success', 'Data buku tersimpan');
        } catch (\Exception $e) {
            return redirect()->route('buku.index')->with('error', 'Data buku gagal tersimpan');
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
    public function update(Request $request, int $id_buku): RedirectResponse
    {
        // Check if book exists
        $buku = BukuModel::where('id_buku', $id_buku)->first();

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }

        // Validate required fields
        if (empty($request->judul_buku) || empty($request->penulis) || empty($request->tahun_terbit)) {
            return redirect()->back()->with('error', 'Data tidak boleh ada yang kosong');
        }

        // Prepare data for update
        $data = [
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'deskripsi_buku' => $request->deskripsi_buku,
            'tahun_terbit' => $request->tahun_terbit
        ];

        // Perform update
        $update = BukuModel::where('id_buku', $id_buku)->update($data);

        if ($update) {
            return redirect()->route('buku.index')->with('success', 'Data buku berhasil diubah');
        }

        return redirect()->back()->with('error', 'Data buku gagal diubah');
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
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
