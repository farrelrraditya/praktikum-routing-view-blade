<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">

                <x-stat-card
                    label="Published Projects"
                    :value="$publishedProjects"
                    color="text-green-600"
                />

                <x-stat-card
                    label="Draft Projects"
                    :value="$draftProjects"
                    color="text-yellow-600"
                />

            </div>

            <div class="bg-white shadow rounded p-6 mt-6">

                <h3 class="font-bold text-lg">
                    Skill Teratas (Data Terbaru)
                </h3>

                <p class="mt-3">
                    {{ $topSkill?->name ?? 'Belum ada skill' }}
                </p>

            </div>

            <div class="bg-white shadow rounded p-6 mt-6">

                <h3 class="font-bold text-lg mb-4">
                    Project Berdasarkan Kategori
                </h3>

                @forelse ($categoriesWithCount as $category)

                    <p class="border-b py-2">
                        {{ $category->name }}:
                        {{ $category->projects_count }} project
                    </p>

                @empty

                    <p>Belum ada kategori.</p>

                @endforelse

            </div>

            <div class="bg-white shadow rounded p-6 mt-6">

                <h3 class="font-bold text-lg mb-4">
                    Lima Project Terbaru
                </h3>

                @forelse ($latestProjects as $project)

                    <div class="border-b py-3">

                        <p class="font-semibold">
                            {{ $project->title }}
                        </p>

                        <p class="text-gray-500 text-sm">
                            {{ $project->category?->name ?? 'Tanpa kategori' }}
                        </p>

                        <p class="text-sm">
                            {{ $project->status }}
                        </p>

                    </div>

                @empty

                    <p>Belum ada project.</p>

                @endforelse

            </div>

        </div>
    </div>

</x-app-layout>
