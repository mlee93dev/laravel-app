<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
    public function show()
    {
      $books = Book::all();

      return view('books', [
        'books' => $books
      ]);
    }
}
