<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold">Kelola Detail: {{ $master->judul }}</h2>
                <p class="text-gray-600">Mata Kuliah: {{ $master->kode_mata_kuliah }}</p>
            </div>
            <a href="{{ route('master.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali ke Master</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <a href="{{ route('details.create', $master->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Langkah (Detail)
        </a>

        <table class="w-full text-left border-collapse mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Urutan</th>
                    <th class="border p-2">Isi (Teks/Code/Gambar)</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($details as $d)
                <tr>
                    <td class="border p-2 text-center font-bold">{{ $d->order }}</td>
                    <td class="border p-2">
                        @if($d->text) <p class="mb-1"><strong>Teks:</strong> {{ Str::limit($d->text, 50) }}</p> @endif
                        @if($d->code) <p class="mb-1 text-xs bg-gray-100 p-1 rounded"><strong>Code:</strong> {{ Str::limit($d->code, 30) }}</p> @endif
                        @if($d->gambar) <p class="text-xs text-blue-500">[Ada Gambar Lampiran]</p> @endif
                    </td>
                    <td class="border p-2 text-center">
                        <span class="px-2 py-1 rounded text-sm text-white {{ $d->status == 'show' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ strtoupper($d->status) }}
                        </span>
                    </td>
                    <td class="border p-2 text-center">
                        <form action="{{ route('details.toggle', $d->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Ubah Status
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="border p-2 text-center text-gray-500">Belum ada langkah tutorial.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>