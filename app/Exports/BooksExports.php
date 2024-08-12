<?php
namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Book::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'judul',
            'kategori',
            'jumlah',
        ];
    }
}
