<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                <x-stat-card
                    label="Projects"
                    :value="$totalProjects"
                />

                <x-stat-card
                    label="Categories"
                    :value="$totalCategories"
                    color="text-green-600"
                />

                <x-stat-card
                    label="Technologies"
                    :value="$totalTechnologies"
                    color="text-purple-600"
                />

                <x-stat-card
                    label="Skills"
                    :value="$totalSkills"
                    color="text-orange-600"
                />

            </div>

            <div class="mt-6 bg-white rounded-lg shadow p-6">

                <h2 class="font-bold text-xl mb-4">
                    Lima Project Terbaru
                </h2>

                <ul>
                    @forelse ($latestProjects as $project)

                        <li class="border-b py-3">

                            <p class="font-semibold">
                                {{ $project->title }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $project->category?->name ?? 'Tanpa kategori' }}
                            </p>

                        </li>

                    @empty

                        <li>Belum ada project.</li>

                    @endforelse
                </ul>

            </div>

        </div>
    </div>

</x-app-layout>
