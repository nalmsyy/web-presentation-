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
}