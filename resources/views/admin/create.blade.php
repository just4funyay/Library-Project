<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class ="mt-4">
                <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                    @csrf
                    <x-input-label for="judul" :value="__('Judul')"/>
                    <x-text-input id="judul" class="block mt-1" type="text" name="judul" :value="old('judul')"/>
                    <x-input-label for="kategori" :value="__('Kategori')"/>
                    <select name="kategori" id="kategori">
                        <option value="Novel">Novel</option>
                        <option value="Komik">Komik</option>
                        <option value="Biografi">Biografi</option>
                        <option value="Buku ilmiah">Buku Ilmiah</option>
                        <option value="Filsafat">Filsafat</option>
                    </select><br>
                    
                    <x-input-label for="deskripsi" :value="__('Deskripsi')"/>
                    <x-text-area id="deskripsi" :value="old('deskripsi')" class="block mt-1 w-half" name="deskripsi"/>{{ old('deskripsi') }}</textarea>
                    
                    <x-input-label for="jumlah" :value="__('Jumlah')"/>
                    <x-text-input id="jumlah" class="block mt-1" type="number" name="jumlah"/>
                    
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                    
                    <label for="pdf">PDF:</label>
                    <input type="file" id="pdf" name="pdf" accept="application/pdf" required>
                    
                    <x-primary-button class="mt-3">
                    {{ __('Submit') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
