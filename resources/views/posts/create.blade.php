<!DOCTYPE html>
<html>
<head>
    <title>Tambah Post</title>
</head>
<body>

    <h1>Tambah Post</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <label>Title</label>
        <br>
        <input type="text" name="title" value="{{ old('title') }}">
        <br><br>

        <label>Description</label>
        <br>
        <textarea name="description">{{ old('description') }}</textarea>
        <br><br>

        <button type="submit">Simpan</button>
    </form>

</body>
</html>