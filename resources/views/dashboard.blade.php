<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Histori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
            @if ($borrows->isEmpty())
                <p>Anda belum meminjam buku.</p>
            @else
                <div class="grid md:grid-cols-3 grid-cols-1">
                @foreach ($borrows as $borrow)
                <div class="max-w-sm rounded overflow-hidden shadow-lg mt-5">
                    <img class="w-full" src="{{ url('storage/'.$borrow->book->image) }}" alt=" {{url('storage/'.$borrow->book->image) }} " width="400" height="500">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{$borrow->book->judul}}</div>
                        <p class="text-gray-700 text-base">
                            Kategori: {{$borrow->book->kategori}}
                        </p>
                        <p class="text-gray-700 text-base">
                            {{$borrow->book->deskripsi}}
                        </p>
                        <p class="text-gray-700 text-base">
                            Peminjaman Tanggal: {{$borrow->borrowed_at}}
                        </p>
                        <p class="text-gray-700 text-base">
                            Status:{{ $borrow->returned_at ? $borrow->returned_at : 'Belum Kembali' }}
                        </p>
                        
                        @if (!$borrow->returned_at)
                        <a href="{{route('borrow.show', $borrow->book->id)}}">
                            <x-primary-button class="mt-3">
                                {{ __('View') }}
                            </x-primary-button>
                        </a>
                        @else
                                <span>Buku sudah dikembalikan</span>
                        @endif
                    </div>
                </div>
                @endforeach
                </div>
                
            @endif
            </div>
        </div>
    </div>
</x-app-layout>
