<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$book->judul}}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="max-w-7xl mx-auto mt-5 sm:px-6 lg:px-8 grid">
            <img src="{{ url('storage/'.$book->image) }}" alt="" width="400" 
                height="500">
            <div class ="text-gray-800">
                <h2 class="font-semibold">Judul: {{$book->judul}}</h2>
                <p>Kategori: {{$book->kategori}}</p>
                <p>Deskrpsi: {{$book->deskripsi}}</p>
                <a href="{{ url('storage/'.$book->pdf) }}">
                    <x-primary-button class="mt-3">
                        PDF
                    </x-primary-button>
                </a>
                
            </div>
        </div>
    </div>
</x-app-layout>
