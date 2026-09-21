<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
</head>
<body>

    <h1>Daftar Post</h1>

    @foreach ($posts as $post)
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->description }}</p>
    @endforeach

</body>
</html>