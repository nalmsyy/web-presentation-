<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 flex justify-center">
    <div class="bg-white p-6 rounded shadow w-[700px]">
        <h2 class="text-xl font-bold mb-4">Tambah Langkah Baru</h2>
        <p class="mb-6 text-gray-600">Tutorial: <strong>{{ $master->judul }}</strong></p>

        <form action="{{ route('details.store', $master->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-2 font-bold text-gray-700">Urutan (Order)</label>
                    <input type="number" name="order" required class="border p-2 w-full rounded" placeholder="Contoh: 1">
                </div>
                <div>
                    <label class="block mb-2 font-bold text-gray-700">Status Awal</label>
                    <select name="status" class="border p-2 w-full rounded">
                        <option value="show">SHOW</option>
                        <option value="hide" selected>HIDE</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">Teks Penjelasan (Opsional)</label>
                <textarea name="text" rows="3" class="border p-2 w-full rounded" placeholder="Tulis instruksi langkah di sini..."></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">Code Snippet (Opsional)</label>
                <textarea name="code" rows="5" class="border p-2 w-full rounded font-mono text-sm bg-gray-50" placeholder="<?php echo 'hello world'; ?>"></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">Gambar/Screenshot (Opsional)</label>
                <input type="file" name="gambar" class="border p-2 w-full rounded" accept="image/*">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">URL Eksternal (Opsional)</label>
                <input type="url" name="url" class="border p-2 w-full rounded" placeholder="https://contoh.com">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('details.index', $master->id) }}" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Langkah</button>
            </div>
        </form>
    </div>
</body>
</html>