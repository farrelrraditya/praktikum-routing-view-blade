
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Project
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white p-6 rounded-lg shadow">

                <h1 class="font-bold text-2xl">
                    {{ $project->title }}
                </h1>

                <p class="mt-2 text-gray-500">
                    {{ $project->category?->name ?? 'Tanpa kategori' }}
                </p>

                <p class="mt-4">
                    {{ $project->description }}
                </p>

                @if ($project->thumbnail)
                    <img
                        src="{{ asset('storage/' . $project->thumbnail) }}"
                        alt="{{ $project->title }}"
                        class="w-full max-h-96 object-cover rounded mt-5"
                    >
                @endif

                <h2 class="text-xl font-bold mt-8 mb-4">
                    Gallery Project
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    @forelse ($project->images as $image)

                        <figure>
                            <img
                                src="{{ asset('storage/' . $image->image) }}"
                                alt="{{ $image->caption ?: $project->title }}"
                                class="w-full h-48 object-cover rounded"
                            >

                            @if ($image->caption)
                                <figcaption class="mt-2 text-sm">
                                    {{ $image->caption }}
                                </figcaption>
                            @endif
                        </figure>

                    @empty
                        <p>Belum ada gambar gallery.</p>
                    @endforelse

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
