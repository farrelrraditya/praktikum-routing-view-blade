<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Project
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('post.projects.update', $project) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Judul Project</label>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $project->title) }}"
                               class="border w-full p-2">
                    </div>

                    <div class="mb-4">
                        <label>Deskripsi</label>
                        <textarea name="description"
                                  class="border w-full p-2">{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label>Kategori</label>
                        <select name="category_id" class="border w-full p-2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(old('category_id', $project->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Thumbnail Saat Ini</label>
                        <img src="{{ asset('storage/' . $project->thumbnail) }}"
                             class="w-48 mt-2">
                    </div>

                    <div class="mb-4">
                        <label>Ganti Thumbnail</label>
                        <input type="file"
                               name="thumbnail"
                               accept="image/*"
                               class="border w-full p-2">
                    </div>

                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                        Update Project
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
