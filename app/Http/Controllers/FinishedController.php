<?php

namespace App\Http\Controllers;

use App\Models\MasterTutorial;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FinishedController extends Controller
{
    public function show($url_finished)
    {
        // Cari master tutorial berdasarkan url_finished
        $master = MasterTutorial::where('url_finished', $url_finished)->firstOrFail();

        // Ambil SEMUA detail (baik yang show maupun hide), urutkan berdasarkan order
        $details = $master->details()->orderBy('order', 'asc')->get();

        // Render tampilan (view) menjadi PDF
        $pdf = Pdf::loadView('finished.pdf', compact('master', 'details'));

        // Menampilkan PDF langsung di browser (bisa juga pakai ->download() untuk langsung unduh)
        return $pdf->stream('Tutorial-' . $master->judul . '.pdf');
    }
}