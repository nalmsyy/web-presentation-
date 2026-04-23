<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Master Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 p-8 flex justify-center">
    <div class="bg-white p-6 rounded shadow w-[500px]">
        <h2 class="text-xl font-bold mb-4"><i class="fas fa-edit mr-2"></i>Edit Master Tutorial</h2>

        <form action="{{ route('master.update', $tutorial->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">Judul Tutorial</label>
                <input type="text" name="judul" value="{{ $tutorial->judul }}" required class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-bold text-gray-700">Mata Kuliah</label>
                <select name="mata_kuliah" required class="border p-2 w-full rounded">
                    @foreach($makul as $m)
                        @php
                            $keys = array_keys($m);
                            $kode = $m[$keys[0]] ?? '';
                            $nama = $m[$keys[1]] ?? '';
                            $selected = ($kode == $tutorial->kode_mata_kuliah) ? 'selected' : '';
                        @endphp
                        <option value="{{ $kode }}|{{ $nama }}" {{ $selected }}>
                            {{ $kode }} - {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('master.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>