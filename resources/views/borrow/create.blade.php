<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pinjam Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
            <form action="{{ route('borrow.store') }}" method="POST">
                @csrf
                <label for="book">Pilih Buku:</label>
                <select name="book_id" id="book">
                 @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->judul }}</option>
                 @endforeach
                </select>
                <x-primary-button class="mt-3">
                {{ __('Pinjam') }}
                </x-primary-button>
            </form>
                <div class="grid md:grid-cols-3 grid-cols-1">
            @foreach ($books as $book)
                <div class="max-w-sm rounded overflow-hidden shadow-lg mt-5">
                    <img class="w-full" src="{{ url('storage/'.$book->image) }}" alt=" {{url('storage/'.$book->image) }} " width="400" height="500">
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
                </div>
                @endforeach
            </div>
            
            </div>
        </div>
    </div>
</x-app-layout>
