<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $master->judul }} - Presentation</title>
    
    <meta http-equiv="refresh" content="5">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50 text-gray-800 p-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-2">{{ $master->judul }}</h1>
        <p class="text-gray-500 mb-8 border-b pb-4">
            Mata Kuliah: {{ $master->kode_mata_kuliah }} - {{ $master->nama_mata_kuliah }} <br>
            Dibuat oleh: {{ $master->creator_email }}
        </p>

        <div class="space-y-8">
            @forelse($details as $d)
                <div class="border-l-4 border-blue-500 pl-4">
                    <h3 class="font-bold text-lg mb-2 text-blue-600">Langkah {{ $d->order }}</h3>
                    
                    @if($d->text)
                        <p class="mb-4 text-gray-700 whitespace-pre-line">{{ $d->text }}</p>
                    @endif

                    @if($d->code)
                        <div class="mb-4">
                            <pre><code class="language-php">{{ $d->code }}</code></pre>
                        </div>
                    @endif

                    @if($d->url)
                        <p class="mb-4">
                            <a href="{{ $d->url }}" target="_blank" class="text-blue-500 underline hover:text-blue-700">Buka Tautan: {{ $d->url }}</a>
                        </p>
                    @endif

                    @if($d->gambar)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $d->gambar) }}" alt="Langkah {{ $d->order }}" class="max-w-full h-auto border rounded shadow-sm">
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-center text-gray-500 italic">Belum ada langkah yang ditampilkan saat ini. Menunggu instruksi dosen...</p>
            @endforelse
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
</body>
</html>