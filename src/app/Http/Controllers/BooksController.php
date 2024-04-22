<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Book;
use SoapBox\Formatter\Formatter;

class BooksController extends Controller
{
    public function show(Request $request)
    {
      $sort = $request->input('sort') ? $request->input('sort') : 'created_at';
      $books = Book::orderBy($sort, 'asc')->get();

      return view('books', [
        'books' => $books
      ]);
    }

    public function search(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'search' => 'max:255'
      ]);
    
      if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
      }

      $books = Book::where('title', 'LIKE', "%{$request->search}%")
                 ->orWhere('author', 'LIKE', "%{$request->search}%");

      return view('books', [
        'books' => $books->get()
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

    public function delete(Book $book)
    {
      $book->delete();
 
      return redirect('/');
    }

    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'author_input_'.$id => 'required|max:255'
      ]);
    
      if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
      }

      $book = Book::where('id', $id)->update([
        'author' => $request->get('author_input_'.$id)
      ]);

      return redirect('/');
    }

    public function download(Request $request)
    {
      $format = $request->format_select;
      $columns = $request->columns_select;

      dd($format, $columns);
    }
}
