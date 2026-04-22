<?php

namespace App\Http\Controllers;

use App\Models\MasterTutorial;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function show($url_presentation)
    {
        // Cari master tutorial berdasarkan url_presentation
        $master = MasterTutorial::where('url_presentation', $url_presentation)->firstOrFail();

        // Ambil hanya detail yang statusnya 'show', urutkan berdasarkan order
        $details = $master->details()->where('status', 'show')->orderBy('order', 'asc')->get();

        return view('presentation.show', compact('master', 'details'));
    }
}