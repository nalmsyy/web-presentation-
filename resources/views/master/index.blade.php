<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Master Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Data Master Tutorial</h2>
            <div class="flex space-x-2">
                <p class="text-gray-600 mt-2 mr-4">User: {{ session('user_email') }}</p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <a href="{{ route('master.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block transition">
            <i class="fas fa-plus mr-2"></i> Tambah Tutorial
        </a>

        <table class="w-full text-left border-collapse mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Judul</th>
                    <th class="border p-2">Mata Kuliah</th>
                    <th class="border p-2">URL Presentation</th>
                    <th class="border p-2">URL Finished</th>
                    <th class="border p-2 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tutorials as $t)
                <tr class="hover:bg-gray-50">
                    <td class="border p-2">{{ $t->judul }}</td>
                    <td class="border p-2">{{ $t->kode_mata_kuliah }} - {{ $t->nama_mata_kuliah }}</td>
                    <td class="border p-2 text-blue-500"><a href="/presentation/{{ $t->url_presentation }}" target="_blank" class="hover:underline"><i class="fas fa-external-link-alt text-xs mr-1"></i>/presentation</a></td>
                    <td class="border p-2 text-blue-500"><a href="/finished/{{ $t->url_finished }}" target="_blank" class="hover:underline"><i class="fas fa-file-pdf text-xs mr-1"></i>/finished (PDF)</a></td>
                    <td class="border p-2 text-center space-x-3">
                        <a href="{{ route('details.index', $t->id) }}" class="text-blue-500 hover:text-blue-700 transition" title="Kelola Langkah Detail">
                            <i class="fas fa-list-ul text-lg"></i>
                        </a>
                        <a href="{{ route('master.edit', $t->id) }}" class="text-yellow-500 hover:text-yellow-700 transition" title="Edit Judul/Matkul">
                            <i class="fas fa-edit text-lg"></i>
                        </a>
                        <form action="{{ route('master.destroy', $t->id) }}" method="POST" class="inline" onsubmit="return confirm('PERINGATAN: Semua langkah detail pada tutorial ini juga akan ikut terhapus! Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Hapus Tutorial">
                                <i class="fas fa-trash-alt text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="border p-2 text-center text-gray-500">Belum ada tutorial yang dibuat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>