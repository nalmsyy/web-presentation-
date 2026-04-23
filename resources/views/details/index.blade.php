<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold">Kelola Detail: {{ $master->judul }}</h2>
                <p class="text-gray-600">Mata Kuliah: {{ $master->kode_mata_kuliah }}</p>
            </div>
            <a href="{{ route('master.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <a href="{{ route('details.create', $master->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block transition">
            <i class="fas fa-plus mr-2"></i> Tambah Langkah
        </a>

        <table class="w-full text-left border-collapse mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2 w-16 text-center">Urutan</th>
                    <th class="border p-2">Isi (Teks/Code/Gambar)</th>
                    <th class="border p-2 w-24 text-center">Status</th>
                    <th class="border p-2 w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($details as $d)
                <tr class="hover:bg-gray-50">
                    <td class="border p-2 text-center font-bold">{{ $d->order }}</td>
                    <td class="border p-2">
                        @if($d->text) <p class="mb-1"><strong><i class="fas fa-align-left mr-1"></i>Teks:</strong> {{ Str::limit($d->text, 50) }}</p> @endif
                        @if($d->code) <p class="mb-1 text-xs bg-gray-100 p-1 rounded font-mono"><strong><i class="fas fa-code mr-1"></i>Code:</strong> {{ Str::limit($d->code, 30) }}</p> @endif
                        @if($d->gambar) <p class="text-xs text-blue-500"><i class="fas fa-image mr-1"></i>[Ada Lampiran Gambar]</p> @endif
                        @if($d->url) <p class="text-xs text-blue-500"><i class="fas fa-link mr-1"></i>[Ada Tautan URL]</p> @endif
                    </td>
                    <td class="border p-2 text-center">
                        <span class="px-2 py-1 rounded text-sm text-white {{ $d->status == 'show' ? 'bg-green-500' : 'bg-red-500' }}">
                            @if($d->status == 'show') <i class="fas fa-eye"></i> @else <i class="fas fa-eye-slash"></i> @endif {{ strtoupper($d->status) }}
                        </span>
                    </td>
                    <td class="border p-2 text-center space-x-3">
                        <form action="{{ route('details.toggle', $d->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="{{ $d->status == 'show' ? 'text-yellow-500 hover:text-yellow-600' : 'text-green-500 hover:text-green-600' }} transition" title="Ubah Status Show/Hide">
                                <i class="fas fa-sync-alt text-lg"></i>
                            </button>
                        </form>
                        
                        <a href="{{ route('details.edit', $d->id) }}" class="text-blue-500 hover:text-blue-700 transition" title="Lihat & Edit Langkah">
                            <i class="fas fa-edit text-lg"></i>
                        </a>

                        <form action="{{ route('details.destroy', $d->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus langkah ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Hapus Langkah">
                                <i class="fas fa-trash-alt text-lg"></i>
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