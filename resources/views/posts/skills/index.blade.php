<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Daftar Skill
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white p-6 shadow rounded-lg">

                @if (session('success'))
                    <p class="text-green-600 mb-4">
                        {{ session('success') }}
                    </p>
                @endif

                <h3 class="text-xl font-bold mb-4">
                    Data Skill
                </h3>

                @forelse ($skills as $skill)

                    <div class="flex justify-between border-b py-3">

                        <span>{{ $skill->name }}</span>

                        <a
                            href="{{ route('post.skills.edit', $skill) }}"
                            class="text-blue-600"
                        >
                            Edit
                        </a>

                    </div>

                @empty
                    <p>Belum ada data skill.</p>
                @endforelse

            </div>

        </div>
    </div>

</x-app-layout>
