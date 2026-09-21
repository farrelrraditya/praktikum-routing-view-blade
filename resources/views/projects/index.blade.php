<!DOCTYPE html>
<html>
<head>
    <title>Daftar Project</title>
</head>
<body>

    <h1>Daftar Project</h1>

    @foreach ($projects as $project)
        <h2>{{ $project->title }}</h2>
        <p>{{ $project->description }}</p>
    @endforeach

</body>
</html>