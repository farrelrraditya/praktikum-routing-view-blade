<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Profil Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <h1>Halaman Profil Saya</h1>

            <p>
                Selamat datang, {{ Auth::user()->name }}!
            </p>
        </div>
    </div>
</x-app-layout>