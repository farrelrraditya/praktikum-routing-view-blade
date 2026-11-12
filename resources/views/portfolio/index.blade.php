
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Portfolio Project</title>
</head>
<body>

    <h1>Daftar Project</h1>

    @foreach ($projects as $project)
        <div>
            <h2>{{ $project->title }}</h2>

            <img
                src="{{ asset('storage/' . $project->thumbnail) }}"
                width="250"
                alt="{{ $project->title }}"
            >

            <p>{{ $project->description }}</p>

            <a href="{{ route('portfolio.projects.show', $project) }}">
                Lihat Detail
            </a>
        </div>
    @endforeach

</body>
</html>
