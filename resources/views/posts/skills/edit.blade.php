<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Skill
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white p-6 shadow rounded-lg">

                <form
                    action="{{ route('post.skills.update', $skill) }}"
                    method="POST"
                >

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block mb-2">
                            Nama Skill
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $skill->name) }}"
                            class="border rounded w-full p-2"
                        >

                        @error('name')
                            <p class="text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Perbarui Skill
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
