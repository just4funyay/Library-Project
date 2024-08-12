<x-app-layout>
    <x-slot name="header">
        <div class="items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('List Buku') }}
            </h2>
            <a href="{{ route('admin.create') }}">
                <button class="bg-gray-100 px-10 py-2 rounded-md">+ Tambah</button>
            </a>
            <a href="{{ route('admin.export') }}">
                <button class="bg-gray-100 px-10 py-2 rounded-md">Export</button>
            </a>

    <form method="GET" action="{{ route('admin.dashboard') }}" class="mt-3">
        <select name="kategori">
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>
        <<button class="bg-gray-100 px-10 py-2 rounded-md">Filter</button>
    </form>
        </div>
        

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 grid-cols-1">
            @foreach ($booksfilter as $book)
                <div class="max-w-sm rounded overflow-hidden shadow-lg mt-5">
                    <img class="w-full" src="{{ url('storage/'.$book->image) }}" alt=" {{url('storage/'.$book->image) }} ">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{$book->judul}}</div>
                        <p class="text-gray-700 text-base">
                            Kategori: {{$book->kategori}}
                        </p>
                        <p class="text-gray-700 text-base">
                            {{$book->deskripsi}}
                        </p>
                        <p class="text-gray-700 text-base">
                            Jumlah: {{$book->jumlah}}
                        </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <a href="{{route('admin.edit', $book)}}"><button class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Edit</button></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
