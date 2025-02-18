<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
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
    public function store(Request $request)
    {
        //
        if (empty($request->judul_buku) || empty($request->penulis) || empty($request->tahun_terbit)):
            $pesan = [
                [
                    'status' => false,
                    'message' => 'data tidak boleh ada yang kosong'
                ],
            ];
            return view('pages.result.failure')->with('pesan', $pesan);
            $status = 403;
        else:
            $data = [
                'judul_buku' => $request->judul_buku,
                'deskripsi_buku' => $request->deskripsi_buku,
                'penulis' => $request->penulis,
                'tahun_terbit' => $request->tahun_terbit
            ];

            BukuModel::create($data);
            $pesan = [
                [
                    'status' => true,
                    'message' => 'data buku tersimpan'
                ],
            ];
            return view('pages.result.success')->with('pesan', $pesan);
            $status = 200;
        endif;

        return response()->json(
            [
                'message' => $pesan
            ]
        );
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
    public function update(Request $request, int $id_buku)
    {
        if (empty($request->judul_buku) || empty($request->penulis) || empty($request->tahun_terbit)):
            $pesan = [
                'status' => false,
                'message' => 'data tidak boleh ada yang kosong'
            ];
            $status = 403;
        else:
            $data = [
                'judul_buku' => $request->judul_buku,
                'penulis' => $request->penulis,
                'deskripsi_buku' => $request->deskripsi_buku,
                'tahun_terbit' => $request->tahun_terbit
            ];
            $update = BukuModel::where('id_buku', '=', $id_buku)->update($data);
            if ($update):
                $pesan = [
                    'status' => true,
                    'message' => 'data buku berhasil diubah'
                ];
                $status = 200;
            else:
                $pesan = [
                    'status' => false,
                    'message' => 'data buku gagal diubah'
                ];
                $status = 400;
            endif;
        endif;
        return response()
            ->json($pesan, $status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id_buku)
    {
        $buku = BukuModel::where('id_buku', $id_buku)->delete();
        if ($buku == true) {
            return response()->json(
                [
                    'message' => 'buku berhasil dihapus'
                ],
                $status = 403,
            );
        } else {
            return response()->json(
                [
                    'message' => 'buku gagal dihapus'
                ],
                $status = 200,
            );
        }
    }
}
