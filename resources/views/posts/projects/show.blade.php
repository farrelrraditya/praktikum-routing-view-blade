<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail dan Gallery Project
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-6">

            <div class="bg-white p-6 rounded-lg shadow">

                <h1 class="text-2xl font-bold">
                    {{ $project->title }}
                </h1>

                <p class="text-gray-600 mt-2">
                    {{ $project->description }}
                </p>

                @if (session('success'))
                    <p class="text-green-600 mt-4">
                        {{ session('success') }}
                    </p>
                @endif

                <h2 class="font-bold text-xl mt-8 mb-3">
                    Tambah Gambar Gallery
                </h2>

                <form
                    action="{{ route('post.projects.gallery.store', $project) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <input
                        type="file"
                        name="images[]"
                        accept="image/*"
                        multiple
                    >

                    @error('images')
                        <p class="text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    @foreach ($errors->get('images.*') as $messages)
                        @foreach ($messages as $message)
                            <p class="text-red-600 mt-2">
                                {{ $message }}
                            </p>
                        @endforeach
                    @endforeach

                    <button
                        type="submit"
                        class="block bg-blue-600 text-white px-4 py-2 rounded mt-4"
                    >
                        Upload Gallery
                    </button>

                </form>

                <h2 class="font-bold text-xl mt-8 mb-4">
                    Gallery Project
                    ({{ $project->images->count() }}/10)
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    @forelse ($project->images as $image)

                        <div class="border rounded p-3">

                            <img
                                src="{{ asset('storage/' . $image->image) }}"
                                alt="{{ $image->caption ?: $project->title }}"
                                class="w-full h-48 object-cover rounded"
                            >

                            <p class="mt-2 text-sm">
                                {{ $image->caption ?? 'Tanpa caption' }}
                            </p>

                            <form
                                action="{{ route('post.projects.gallery.caption.update', [$project, $image]) }}"
                                method="POST"
                                class="mt-3"
                            >
                                @csrf
                                @method('PUT')

                                <input
                                    type="text"
                                    name="caption"
                                    value="{{ old('caption', $image->caption) }}"
                                    placeholder="Masukkan caption"
                                    class="border rounded w-full p-2"
                                >

                                @error('caption')
                                    <p class="text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                                <button
                                    type="submit"
                                    class="bg-green-600 text-white px-3 py-2 rounded mt-2"
                                >
                                    Update Caption
                                </button>

                            </form>

                            <form
                                action="{{ route('post.projects.gallery.destroy', [$project, $image]) }}"
                                method="POST"
                                class="mt-3"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-red-600"
                                >
                                    Hapus Gambar
                                </button>
                            </form>

                        </div>

                    @empty

                        <p>Belum ada gambar gallery.</p>

                    @endforelse

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
