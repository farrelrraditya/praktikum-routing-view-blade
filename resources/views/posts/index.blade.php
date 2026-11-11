<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Post</title>

    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 font-sans">

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Post</h1>

        <!-- Form Pencarian & Limit Per Halaman -->
        <form method="GET" action="{{ url('/posts') }}" class="mb-6 flex flex-wrap gap-3 items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex items-center gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari judul post..."
                    class="border border-gray-300 p-2 rounded-lg text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Terapkan
                </button>
                <a href="{{ url('/posts') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Reset
                </a>
            </div>

            <div class="flex items-center gap-2">
                <label for="perPage" class="text-sm font-medium text-gray-700">Data per halaman:</label>
                <select name="perPage" id="perPage" onchange="this.form.submit()" class="border border-gray-300 p-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                </select>
            </div>
        </form>

        <!-- Tabel Data Post -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 mb-6">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3 w-16 text-center">No</th>
                        <th class="px-4 py-3">Judul Post</th>
                        <th class="px-4 py-3">Deskripsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($posts as $post)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-center font-medium text-gray-500">
                                {{ $posts->firstItem() + $loop->index }}
                            </td>
                            <td class="px-4 py-3 font-semibold text-gray-900">
                                {{ $post->title }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $post->description }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-gray-400">
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

                <!-- Footer & Navigasi Pagination -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
            <!-- Info Status Data -->
            <div class="text-sm text-gray-600">
                Halaman: <span class="font-semibold text-gray-800">{{ $posts->currentPage() }}</span> <br>
                Jumlah Data: <span class="font-semibold text-gray-800">{{ $posts->total() }}</span> <br>
                Data Per Halaman: <span class="font-semibold text-gray-800">{{ $posts->perPage() }}</span>
            </div>

            <!-- Tombol Navigasi Manual (Rapi & Horisontal) -->
            <div class="flex items-center gap-1">
                {{-- Tombol Previous --}}
                @if ($posts->onFirstPage())
                    <span class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">« Prev</span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}" class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 transition-colors">« Prev</a>
                @endif

                {{-- Angka Halaman --}}
                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                    @if ($page == $posts->currentPage())
                        <span class="px-3 py-1.5 text-sm font-semibold text-white bg-blue-600 rounded-md">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 transition-colors">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}" class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 transition-colors">Next »</a>
                @else
                    <span class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">Next »</span>
                @endif
            </div>
        </div>
    </div>

</body>
</html>