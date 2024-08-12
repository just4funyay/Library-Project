<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    public function index(Request $request){
        $books = Book::paginate(6);
        $query = Book::query();
        if ($request->has('kategori') && $request->input('kategori') !== '') {
            $query->where('kategori', $request->input('kategori'));
        }
        $booksfilter = $query->get();
        $categories = Book::distinct()->pluck('kategori');

        return view('admin.dashboard', compact('booksfilter','categories'));
    }

    public function export(){
        return Excel::download(new BooksExport, 'books.csv');
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|',
        ]);
        
        $pathpdf = '';
        $image = $request->file('image');
        $filename = date('Y-m-d').$image->getClientOriginalName();
        $pathbook = 'book-image/'.$filename;
        if ($request->hasFile('pdf')){
            $pdf = $request->file('pdf');
            $filepdf = $pdf->getClientOriginalName();
            $pathpdf = 'pdf-file/'.$filepdf;
            Storage::disk('public')->put($pathpdf,file_get_contents($pdf));


        }
        
        Storage::disk('public')->put($pathbook,file_get_contents($image));
        
        Book::create([
            'judul'=>$request->judul,
            'kategori'=>$request->kategori,
            'deskripsi'=>$request->deskripsi,
            'jumlah'=>$request->jumlah,
            'image'=>$pathbook,
            'pdf'=>$pathpdf
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'buku berhasil ditambahkan');
    }

    public function edit(Book $book){
        return view('admin.edit',compact('book'));
    }

    public function update(Request $request, Book $book){

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            
            $uploadedFile = $request->file('image');
    
            
            $filename = date('Y-m-d') . '-' . $uploadedFile->getClientOriginalName();
            $pathbook = 'book-image/' . $filename;
    
            
            $uploadedFile->storeAs('book-image', $filename, 'public');
    
            
            $book->image = $pathbook;
        }

        if ($request->hasFile('pdf')) {
        $uploadedPdf = $request->file('pdf');
        $pdfFilename = $uploadedPdf->getClientOriginalName();
        $pdfPath = 'pdf-file/' . $pdfFilename;

        $uploadedPdf->storeAs('pdf-file', $pdfFilename, 'public');
        $book->pdf = $pdfPath;
    }
    
        
        $book->judul = $request->judul;
        $book->kategori = $request->kategori;
        $book->deskripsi = $request->deskripsi;
        $book->jumlah = $request->jumlah;
    
        $book->update();
        return redirect()->route('admin.dashboard')->with('success', 'update sukses');
    }

    public function destroy(Book $book){
        $book->delete();
        return redirect()->route('admin.dashboard')->with('success', 'delete sukses');
    }

}
