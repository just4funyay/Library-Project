<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;

class BorrowController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        $borrows = Borrow::where('user_id', $user->id)
                         ->with('book')
                         ->orderBy('borrowed_at', 'desc')
                         ->get();

        return view('dashboard', compact('borrows'));
    }
    public function create()
    {
        $books = Book::paginate(6); // Ambil semua buku
        return view('borrow.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::find($request->book_id);

        if ($book->jumlah <= 0) {
            return redirect()->route('borrow.create')->with('error', 'Stok buku tidak tersedia.');
        }

        $borrow = new Borrow();
        $borrow->book_id = $request->book_id;
        $borrow->user_id = Auth::id();
        $borrow->borrowed_at = now();
        $borrow->save();

        $book->jumlah--;
        $book->save();

        return redirect()->route('borrow.create')->with('success', 'Buku berhasil dipinjam.');
    }

        public function myBooks()
    {
        $user = Auth::user();
        $borrows = Borrow::where('user_id', $user->id)
                        ->whereNull('returned_at')
                        ->with('book')
                        ->get();

        return view('borrow.my-books', compact('borrows'));
    }

    public function return($id)
    {
        $borrow = Borrow::findOrFail($id);

        // Pastikan peminjaman buku ini milik pengguna yang saat ini login
        if ($borrow->user_id !== Auth::id() || $borrow->returned_at !== null) {
            return redirect()->route('borrow.my-books')->with('error', 'Buku tidak dapat dikembalikan.');
        }

        $borrow->returned_at = now();
        $borrow->save();

        // Tambah kuantitas buku kembali
        $book = $borrow->book;
        $book->jumlah++;
        $book->save();

        return redirect()->route('borrow.my-books')->with('success', 'Buku berhasil dikembalikan.');
    }

    public function show($id){
        $book = Book::findOrFail($id); // Ambil buku berdasarkan ID atau tampilkan 404 jika tidak ditemukan
        return view('borrow.show', compact('book'));
    }

}
