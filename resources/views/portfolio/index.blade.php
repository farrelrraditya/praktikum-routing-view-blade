
<h2>Daftar Project</h2>

{{-- Form Search dan Filter Status --}}
<form action="{{ route('post.projects.index') }}" method="GET">

    {{-- Search --}}
    <div>
        <label for="search">Cari Project:</label>
        <input
            type="text"
            name="search"
            id="search"
            placeholder="Masukkan judul atau deskripsi..."
            value="{{ request('search') }}"
        >
    </div>

    {{-- Filter Status --}}
    <div>
        <label for="status">Status Project:</label>
        <select name="status" id="status">
            <option value="">Semua Status</option>

            <option
                value="draft"
                {{ request('status') == 'draft' ? 'selected' : '' }}
            >
                Draft
            </option>

            <option
                value="published"
                {{ request('status') == 'published' ? 'selected' : '' }}
            >
                Published
            </option>
        </select>
    </div>

    <button type="submit">Terapkan</button>

    {{-- Reset Search dan Filter --}}
    <a href="{{ route('post.projects.index') }}">
        Reset
    </a>

</form>

<hr>

{{-- Jumlah hasil --}}
<p>
    {{ $projects->total() }} project ditemukan.
</p>

{{-- Daftar Project --}}
@forelse ($projects as $project)

    <div>
        <h2>{{ $project->title }}</h2>

        <p>{{ $project->description }}</p>

        @if ($project->thumbnail)
            <img
                src="{{ asset('storage/' . $project->thumbnail) }}"
                width="200"
                alt="{{ $project->title }}"
            >
        @endif

        <p>
            Status:
            {{ ucfirst($project->status) }}
        </p>

        {{-- Tombol Detail --}}
        <a href="{{ route('post.projects.show', $project) }}">
            Detail
        </a>

        {{-- Tombol Edit --}}
        <a href="{{ route('post.projects.edit', $project) }}">
            Edit
        </a>

        {{-- Tombol Delete --}}
        <form
            action="{{ route('post.projects.destroy', $project) }}"
            method="POST"
            onsubmit="return confirm('Yakin ingin menghapus project ini?')"
        >
            @csrf
            @method('DELETE')

            <button type="submit">
                Hapus Project
            </button>
        </form>
    </div>

    <hr>

@empty

    <p>Project tidak ditemukan.</p>

@endforelse

{{-- Pagination --}}
<div>
    {{ $projects->links() }}
</div>