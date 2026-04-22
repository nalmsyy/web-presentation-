<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $master->judul }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }
        .step {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ccc;
        }
        .step h3 {
            margin-top: 0;
            color: #0056b3;
        }
        .code-block {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            padding: 10px;
            font-family: "Courier New", Courier, monospace;
            white-space: pre-wrap;
            font-size: 12px;
            border-radius: 4px;
        }
        .img-container {
            margin-top: 10px;
            text-align: center;
        }
        .img-container img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
        }
        .link {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>{{ $master->judul }}</h1>
        <p>Mata Kuliah: {{ $master->kode_mata_kuliah }} - {{ $master->nama_mata_kuliah }}</p>
        <p>Kreator: {{ $master->creator_email }}</p>
    </div>

    @forelse($details as $d)
        <div class="step">
            <h3>Langkah {{ $d->order }}</h3>
            
            @if($d->text)
                <p>{!! nl2br(e($d->text)) !!}</p>
            @endif

            @if($d->code)
                <div class="code-block">{{ $d->code }}</div>
            @endif

            @if($d->url)
                <p><strong>Tautan Referensi:</strong> <a href="{{ $d->url }}" class="link">{{ $d->url }}</a></p>
            @endif

            @if($d->gambar)
                <div class="img-container">
                    <img src="{{ public_path('storage/' . $d->gambar) }}" alt="Gambar Langkah {{ $d->order }}">
                </div>
            @endif
        </div>
    @empty
        <p style="text-align: center; font-style: italic;">Tutorial ini belum memiliki detail langkah.</p>
    @endforelse

</body>
</html>