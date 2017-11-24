<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Hash;
use Config;
use Carbon\Carbon;
use App\Book;
use App\Utilities\Practice;

class BookController extends Controller
{

	/**
       * GET /
       */
       public function index()
       {
           //$jsonPath = database_path('books.json');
           //$booksJson = file_get_contents($jsonPath);
           //$books = json_decode($booksJson, true);
           $books = Book::orderBy('title')->get();

           //$newBooks = Book::orderByDesc('created_at')->limit(3)->get();
           $newBooks = $books->sortByDesc('created_at')->take(3);

           return view('book.index')->with([
               'books' => $books,
               'newBooks' => $newBooks,
          ]);
       }


       /**
       * GET /book/{$id}
       */
       public function show($id)
       {
           $book = Book::find($id);

           if (!$book) {
               return redirect('/book')->with('alert', 'Book not found.');
           }
           return view('book.show')->with([
               'book' => $book
           ]);
       }


       /**
       *
       */
       public function search(Request $request)
       {
           # Start with an empty array of search results; books that
           # match our search query will get added to this array
           $searchResults = [];

           # Store the searchTerm in a variable for easy access
           # The second parameter (null) is what the variable
           # will be set to *if* searchTerm is not in the request.
           $searchTerm = $request->input('searchTerm', null);

           # Only try and search *if* there's a searchTerm
           if ($searchTerm) {
               # Open the books.json data file
               # database_path() is a Laravel helper to get the path to the database folder
               # See https://laravel.com/docs/helpers for other path related helpers
               $booksRawData = file_get_contents(database_path('/books.json'));

               # Decode the book JSON data into an array
               # Nothing fancy here; just a built in PHP method
               $books = json_decode($booksRawData, true);

               # Loop through all the book data, looking for matches
               # This code was taken from v0 of foobooks we built earlier in the semester
               foreach ($books as $title => $book) {
                   # Case sensitive boolean check for a match
                   if ($request->has('caseSensitive')) {
                       $match = $title == $searchTerm;
                       # Case insensitive boolean check for a match
                   } else {
                       $match = strtolower($title) == strtolower($searchTerm);
                   }

                   # If it was a match, add it to our results
                   if ($match) {
                       $searchResults[$title] = $book;
                   }
               }
           }

           # Return the view, with the searchTerm *and* searchResults (if any)
           return view('book.search')->with([
               'searchTerm' => $searchTerm,
               'caseSensitive' => $request->has('caseSensitive'),
               'searchResults' => $searchResults
           ]);
       }


       /**
       *
       */
       public function create()
       {
           return view('book.create')->with([
               'title' => session('title')
           ]);
       }


       /**
       *
       */
       public function store(Request $request)
       {
           // $messages = [
           //     'required' => 'Don\'t forget the :attribute field',
           // ];

           $this->validate($request, [
               'title' => 'required|min:3',
               'author' => 'required',
               'published' => 'required|min:4|numeric',
               'cover' => 'required|url',
               'purchase_link' => 'required|url',
               'page_count' => 'numeric',
               ''
           ]);

           # Add new book to the database
           $newBook = new Book();
           $newBook->title = $request->input('title');
           $newBook->author = $request->input('author');
           $newBook->published = $request->input('published');
           $newBook->cover = $request->input('cover');
           $newBook->purchase_link = $request->input('purchase_link');
           $newBook->page_count = $request->input('page_count');
           $newBook->save();

           return redirect('/book')->with('alert', 'The book '.$request->input('title').  ' was added.');
           #return redirect('/book/'.$title);
           //return redirect('/book/create')->with([
               //'title' => $title
           //]);
       }

    public function edit($id)
    {
        $book = Book::find($id);
        if(!$book) {
            return redirect('/book')->with('alert', 'Book not found');
        }

        return view('book.edit')->with(['book' => $book]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'author' => 'required',
            'published' => 'required|min:4|numeric',
            'cover' => 'required|url',
            'purchase_link' => 'required|url',
            'page_count' => 'numeric',
            ''
        ]);

        $newBook = Book::find($id);

        $newBook->title = $request->input('title');
        $newBook->author = $request->input('author');
        $newBook->published = $request->input('published');
        $newBook->cover = $request->input('cover');
        $newBook->purchase_link = $request->input('purchase_link');
        $newBook->page_count = $request->input('page_count');
        $newBook->save();

        return redirect('/book/'.$id.'/edit')->with('alert', 'Your changes were saved.');

    }

    /*
    * Create a soft delete for books
    */
    # Show the book to be deleted
    public function delete(Request $request, $id)
    {
        $book = Book::find($id);
        if(!$book) {
            return redirect('/book')->with('alert', 'OOppss! System error. Your book was not deleted.');
        } else {
        return view('book.delete')->with([
            'book' => $book
        ]);
        }
    }

    # Delete the book and return visitor to list of all books.
    public function destroy(Request $request)
    {
        $book = Book::where('id', '=', $request->input('id') )->delete();
        return redirect('/book')->with('alert', 'Your selected book was deleted.');
    }


	/**
	* make Hash
	*/
	public function makeHash()
	{
	       return Hash::make('secret');
		//return \Hash::make('secret');
	}

	public function getDate()
	{
        return Carbon::now('Y');
	}

	public function getTimezone()
	{
        return Config::get('app.timezone');
	}
}
