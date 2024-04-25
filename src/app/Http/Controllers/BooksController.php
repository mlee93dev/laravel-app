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

    public function delete(Request $request, $id)
    {
      $book = Book::find($id);
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

      $author = Book::select('author')->from('books')->where('id', $id)->first()->author;
      $books = Book::where('author', $author);

      $books->update([
        'author' => $request->get('author_input_'.$id)
      ]);

      return redirect('/');
    }

    public function download(Request $request)
    {
      $format = $request->format_select;
      $columns = $request->columns_select;

      if ($columns === 'all') {
        $books = Book::select('title', 'author')->get()->toArray();
      } else {
        $books = Book::select($columns)->get()->toArray();
      }
      $formatter = Formatter::make($books, Formatter::ARR);

      if ($format === 'csv') {
        $headers = [
          'Content-Type' => 'text/csv',
          'Content-Disposition' => 'attachment; filename=books.csv',
        ];
        $csv = $formatter->toCsv();

        return \Response::make($csv, 200, $headers);
      } else {
        $headers = [
          'Content-Type' => 'text/xml',
          'Content-Disposition' => 'attachment; filename=books.xml',
        ];
        $xml = $formatter->toXml();

        return \Response::make($xml, 200, $headers);
      }
    }
}
