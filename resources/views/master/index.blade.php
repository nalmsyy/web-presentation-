<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Master Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Data Master Tutorial</h2>
            <div class="flex space-x-2">
                <p class="text-gray-600 mt-2 mr-4">User: {{ session('user_email') }}</p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <a href="{{ route('master.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Tutorial
        </a>

        <table class="w-full text-left border-collapse mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Judul</th>
                    <th class="border p-2">Mata Kuliah</th>
                    <th class="border p-2">URL Presentation</th>
                    <th class="border p-2">URL Finished</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tutorials as $t)
                <tr>
                    <td class="border p-2">{{ $t->judul }}</td>
                    <td class="border p-2">{{ $t->kode_mata_kuliah }} - {{ $t->nama_mata_kuliah }}</td>
                    <td class="border p-2 text-blue-500">
                        <a href="/presentation/{{ $t->url_presentation }}" target="_blank">/presentation/{{ $t->url_presentation }}</a>
                    </td>
                    <td class="border p-2 text-blue-500">
                        <a href="/finished/{{ $t->url_finished }}" target="_blank">/finished/{{ $t->url_finished }}</a>
                    </td>
                    <td class="border p-2">
                        <a href="{{ route('details.index', $t->id) }}" class="bg-green-500 text-white px-3 py-1 rounded text-sm">Kelola Detail</a>
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