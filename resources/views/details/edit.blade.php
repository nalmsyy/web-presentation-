<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lihat & Edit Langkah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 p-8 flex justify-center">
    <div class="bg-white p-6 rounded shadow w-[700px]">
        <h2 class="text-xl font-bold mb-4"><i class="fas fa-edit mr-2 text-blue-500"></i>Lihat & Edit Langkah</h2>
        <p class="mb-6 text-gray-600">Tutorial: <strong>{{ $master->judul }}</strong></p>

        <form action="{{ route('details.update', $detail->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-2 font-bold text-gray-700">Urutan (Order)</label>
                    <input type="number" name="order" value="{{ $detail->order }}" required class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="block mb-2 font-bold text-gray-700">Status Awal</label>
                    <select name="status" class="border p-2 w-full rounded">
                        <option value="show" {{ $detail->status == 'show' ? 'selected' : '' }}>SHOW</option>
                        <option value="hide" {{ $detail->status == 'hide' ? 'selected' : '' }}>HIDE</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">Teks Penjelasan</label>
                <textarea name="text" rows="4" class="border p-2 w-full rounded">{{ $detail->text }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">Code Snippet</label>
                <textarea name="code" rows="5" class="border p-2 w-full rounded font-mono text-sm bg-gray-50">{{ $detail->code }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">URL Eksternal</label>
                <input type="url" name="url" value="{{ $detail->url }}" class="border p-2 w-full rounded">
            </div>

            <div class="mb-6 p-4 border rounded bg-gray-50">
                <label class="block mb-2 font-bold text-gray-700">Gambar/Screenshot</label>
                @if($detail->gambar)
                    <div class="mb-3">
                        <p class="text-sm text-gray-500 mb-1">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $detail->gambar) }}" class="max-h-32 border rounded shadow-sm">
                    </div>
                @endif
                <p class="text-sm text-gray-500 mb-1">Upload gambar baru (Kosongkan jika tidak ingin mengubah):</p>
                <input type="file" name="gambar" class="border p-2 w-full rounded bg-white" accept="image/*">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('details.index', $master->id) }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded transition">Batal / Kembali</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>