<?php

namespace App\Http\Controllers;

use App\Models\MasterTutorial;
use App\Models\TutorialDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TutorialDetailController extends Controller
{
    // Menampilkan daftar detail untuk suatu master tutorial
    public function index($master_id)
    {
        $master = MasterTutorial::findOrFail($master_id);
        // Mengurutkan berdasarkan 'order' (urutan langkah)
        $details = $master->details()->orderBy('order', 'asc')->get();
        
        return view('details.index', compact('master', 'details'));
    }

    // Menampilkan form tambah detail
    public function create($master_id)
    {
        $master = MasterTutorial::findOrFail($master_id);
        return view('details.create', compact('master'));
    }

    // Menyimpan data detail
    public function store(Request $request, $master_id)
    {
        $request->validate([
            'order' => 'required|integer',
            'status' => 'required|in:show,hide',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPath = null;
        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('tutorial_images', 'public');
        }

        TutorialDetail::create([
            'master_tutorial_id' => $master_id,
            'text' => $request->text,
            'gambar' => $gambarPath,
            'code' => $request->code,
            'url' => $request->url,
            'order' => $request->order,
            'status' => $request->status,
        ]);

        return redirect()->route('details.index', $master_id)->with('success', 'Detail tutorial berhasil ditambahkan!');
    }

    // Fitur ganti status show/hide dengan cepat
    public function toggleStatus($id)
    {
        $detail = TutorialDetail::findOrFail($id);
        $detail->status = $detail->status === 'show' ? 'hide' : 'show';
        $detail->save();

        return back()->with('success', 'Status langkah ke-' . $detail->order . ' berhasil diubah menjadi ' . $detail->status);
    }

    // Menghapus data Detail Tutorial (Langkah)
    public function destroy($id)
    {
        $detail = TutorialDetail::findOrFail($id);
        
        // Hapus file gambar dari folder public/storage jika ada
        if ($detail->gambar && Storage::disk('public')->exists($detail->gambar)) {
            Storage::disk('public')->delete($detail->gambar);
        }
        
        $detail->delete();

        return back()->with('success', 'Langkah tutorial berhasil dihapus!');
    }
    // Menampilkan halaman Show sekaligus Edit
    public function edit($id)
    {
        $detail = TutorialDetail::findOrFail($id);
        $master = $detail->masterTutorial; // Mengambil relasi master untuk judul

        return view('details.edit', compact('detail', 'master'));
    }

    // Menyimpan perubahan data detail
    public function update(Request $request, $id)
    {
        $request->validate([
            'order' => 'required|integer',
            'status' => 'required|in:show,hide',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $detail = TutorialDetail::findOrFail($id);
        $gambarPath = $detail->gambar; // Secara default, gunakan gambar lama

        // Jika user mengupload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari storage jika ada
            if ($detail->gambar && Storage::disk('public')->exists($detail->gambar)) {
                Storage::disk('public')->delete($detail->gambar);
            }
            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('tutorial_images', 'public');
        }

        $detail->update([
            'text' => $request->text,
            'gambar' => $gambarPath,
            'code' => $request->code,
            'url' => $request->url,
            'order' => $request->order,
            'status' => $request->status,
        ]);

        return redirect()->route('details.index', $detail->master_tutorial_id)->with('success', 'Langkah tutorial berhasil diperbarui!');
    }
}