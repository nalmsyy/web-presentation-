<?php

namespace App\Http\Controllers;

use App\Models\MasterTutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MasterTutorialController extends Controller
{
    // 1. Menampilkan daftar master tutorial (Tabel)
    public function index()
    {
        // Ambil data tutorial yang dibuat oleh user yang sedang login
        $tutorials = MasterTutorial::where('creator_email', Session::get('user_email'))->get();
        return view('master.index', compact('tutorials'));
    }

    // 2. Menampilkan form tambah data
    public function create()
    {
        $token = Session::get('jwt_token');
        
        // Debug: Cek apakah token ada
        //dd($token); 

        $response = Http::withToken($token)->get('https://jwt-auth-eight-neon.vercel.app/getMakul');
        
        // Debug: Cek respons dari API
        //dd($response->json()); 

        $makul = [];
        if ($response->successful() && isset($response['data'])) {
            $makul = $response['data'];
        }

        return view('master.create', compact('makul'));
    }

    // 3. Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'mata_kuliah' => 'required', // Kita akan kirim kode|nama dari view
        ]);

        // Pecah value mata_kuliah menjadi kode dan nama
        $makulData = explode('|', $request->mata_kuliah);
        $kode_matkul = $makulData[0];
        $nama_matkul = $makulData[1] ?? '';

        // Generate string unik untuk URL Presentation dan Finished
        $slug = Str::slug($request->judul);
        $url_presentation = $slug . '-' . rand(1000000000, 9999999999);
        $url_finished = $slug . '-' . rand(1000000000, 9999999999);

        // Simpan ke database
        MasterTutorial::create([
            'judul' => $request->judul,
            'kode_mata_kuliah' => $kode_matkul,
            'nama_mata_kuliah' => $nama_matkul,
            'url_presentation' => $url_presentation,
            'url_finished' => $url_finished,
            'creator_email' => Session::get('user_email'),
        ]);

        return redirect()->route('master.index')->with('success', 'Master Tutorial berhasil ditambahkan!');
    }

    // Menghapus data Master Tutorial beserta seluruh detailnya
    public function destroy($id)
    {
        $tutorial = MasterTutorial::findOrFail($id);
        $tutorial->delete(); // Karena di migration pakai onDelete('cascade'), detailnya otomatis ikut terhapus

        return redirect()->route('master.index')->with('success', 'Master Tutorial berhasil dihapus!');
    }

    public function edit($id)
    {
    $tutorial = MasterTutorial::findOrFail($id);
    $token = Session::get('jwt_token');
    $makul = [];

    try {
        $response = Http::withToken($token)->get('https://jwt-auth-eight-neon.vercel.app/getMakul');
        if ($response->successful() && isset($response['data'])) {
            $makul = $response['data'];
        }
    } catch (\Exception $e) {
    }

    return view('master.edit', compact('tutorial', 'makul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'mata_kuliah' => 'required',
        ]);

        $makulData = explode('|', $request->mata_kuliah);
        $kode_matkul = $makulData[0];
        $nama_matkul = $makulData[1] ?? '';

        $tutorial = MasterTutorial::findOrFail($id);
        $tutorial->update([
            'judul' => $request->judul,
            'kode_mata_kuliah' => $kode_matkul,
            'nama_mata_kuliah' => $nama_matkul,
        ]);

        return redirect()->route('master.index')->with('success', 'Master Tutorial berhasil diperbarui!');
    }
    
}
