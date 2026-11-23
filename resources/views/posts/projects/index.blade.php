
<h1>Daftar Project</h1>

@foreach ($projects as $project)

    <div>
        <h2>{{ $project->title }}</h2>

        <p>{{ $project->description }}</p>

        <img
            src="{{ asset('storage/' . $project->thumbnail) }}"
            width="200"
        >

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

@endforeach
