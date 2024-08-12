<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
            @include('admin.partials.delete-book')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class ="mt-4 card-body">
                <img src="{{ url('storage/'.$book->image) }}" alt="" width="400" 
                height="500">
                <form method="POST" action="{{ route('admin.update', $book) }}" class="mt-4" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <x-input-label for="judul" :value="__('Judul')"/>
                    <x-text-input id="judul" class="block mt-1" type="text" name="judul" :value="$book->judul"/>
                    <x-input-label for="kategori" :value="__('Kategori')"/>
                    <select name="kategori" id="kategori">
                    <option value="Novel" {{ $book->kategori == 'Novel' ? 'selected' : '' }}>Novel</option>
                        <option value="Komik" {{ $book->kategori == 'Komik' ? 'selected' : '' }}>Komik</option>
                        <option value="Biografi" {{ $book->kategori == 'Biografi' ? 'selected' : '' }}>Biografi</option>
                        <option value="Buku ilmiah" {{ $book->kategori == 'Buku ilmiah' ? 'selected' : '' }}>Buku Ilmiah</option>
                        <option value="Filsafat" {{ $book->kategori == 'Filsafat' ? 'selected' : '' }}>Filsafat</option>
                    </select><br>
                    
                    <x-input-label for="deskripsi" :value="__('Deskripsi')"/>
                    <x-text-area id="deskripsi" :value="$book->deskripsi" class="block mt-1 w-half" name="deskripsi"/></textarea>
                    
                    <x-input-label for="jumlah" :value="__('Jumlah')"/>
                    <x-text-input id="jumlah" class="block mt-1" type="number" name="jumlah" :value="$book->jumlah"/>
                    <br>
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required><br>
                    
                    <label for="pdf">PDF:</label>
                    <input type="file" id="pdf" name="pdf" accept="application/pdf">
                    
                    <x-primary-button class="mt-3">
                    {{ __('Submit') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
