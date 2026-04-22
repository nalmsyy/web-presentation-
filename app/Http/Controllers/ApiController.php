<?php

namespace App\Http\Controllers;

use App\Models\MasterTutorial;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getTutorialByMatkul($kode_matkul)
    {
        // Cari data berdasarkan kode mata kuliah
        $tutorials = MasterTutorial::where('kode_mata_kuliah', $kode_matkul)->get();

        // Jika data kosong, tampilkan response 404 sesuai dokumen spesifikasi
        if ($tutorials->isEmpty()) {
            return response()->json([
                'status' => 404,
                'description' => "Not Found data " . $kode_matkul,
                'results' => []
            ], 404);
        }

        // Jika ada, mapping datanya agar sesuai dengan format JSON di spesifikasi
        $results = $tutorials->map(function ($t) {
            return [
                'kode_matkul' => $t->kode_mata_kuliah,
                'nama_matkul' => $t->nama_mata_kuliah,
                'judul' => $t->judul,
                // Menggunakan url() agar link langsung full http://localhost:8000/...
                'url_presentation' => url('/presentation/' . $t->url_presentation),
                'url_finished' => url('/finished/' . $t->url_finished),
                'creator_email' => $t->creator_email,
                'created_at' => $t->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $t->updated_at->format('Y-m-d H:i:s'),
            ];
        });

        // Tampilkan response 200 OK
        return response()->json([
            'status' => 200,
            'description' => "OK",
            'results' => $results
        ], 200);
    }
}