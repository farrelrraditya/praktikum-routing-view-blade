
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Project
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white p-6 rounded-lg shadow">

                @if (session('success'))
                    <p class="text-green-600 mb-4">
                        {{ session('success') }}
                    </p>
                @endif

                <form
                    action="{{ route('post.projects.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2">
                            Judul Project
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="border rounded w-full p-2"
                        >

                        @error('title')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">
                            Deskripsi
                        </label>

                        <textarea
                            name="description"
                            class="border rounded w-full p-2"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">
                            Kategori
                        </label>

                        <select
                            name="category_id"
                            class="border rounded w-full p-2"
                        >
                            <option value="">Pilih Kategori</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('category_id')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">
                            Thumbnail Project
                        </label>

                        <input
                            type="file"
                            name="thumbnail"
                            accept="image/*"
                        >

                        @error('thumbnail')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded"
                    >
                        Simpan Project
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
