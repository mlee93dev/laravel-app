<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Book;

class BooksController extends Controller
{
    public function show()
    {
      $books = Book::orderBy('created_at', 'asc')->get();

      return view('books', [
        'books' => $books
      ]);
    }

    public function add(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'author' => 'required|max:255'
      ]);
    
      if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
      }
    
      $book = new Book;
      $book->title = $request->title;
      $book->author = $request->author;
      $book->save();
    
      return redirect('/');
    }
}
