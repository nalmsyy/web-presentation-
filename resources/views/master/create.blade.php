<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Master Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 flex justify-center">
    <div class="bg-white p-6 rounded shadow w-[500px]">
        <h2 class="text-xl font-bold mb-4">Buat Master Tutorial Baru</h2>

        <form action="{{ route('master.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">Judul Tutorial</label>
                <input type="text" name="judul" required class="border p-2 w-full rounded" placeholder="Contoh: Hello World dengan PHP">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">Mata Kuliah</label>
                <select name="mata_kuliah" required class="border p-2 w-full rounded">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($makul as $m)
                        @php
                            // Trik Ampuh: Ambil semua nama "kunci" secara otomatis
                            $keys = array_keys($m);
                            
                            // Ambil nilainya berdasarkan urutan (0 untuk kode, 1 untuk nama)
                            $kode_dinamis = $m[$keys[0]] ?? '';
                            $nama_dinamis = $m[$keys[1]] ?? '';
                        @endphp
                        
                        <option value="{{ $kode_dinamis }}|{{ $nama_dinamis }}">
                            {{ $kode_dinamis }} - {{ $nama_dinamis }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">*Data diambil dari API Webservice</p>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('master.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Tutorial</button>
            </div>
        </form>
    </div>
</body>
</html>