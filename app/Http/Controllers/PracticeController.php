<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use cebe\markdown\MarkdownExtra;
use App\Book;

class PracticeController extends Controller
{

	// Start exercises for progress week 11
	#7: Remove any books by the author “J.K. Rowling”.
	Public function practice21() {
		$author = 'J.K. Rowling';
		
		$book = Book::where('author', '=', $author)->delete();

		if($book == 0):
			dump("No book by $author was found");
		else:
			dump("Success. All books $author have been removed.");
		endif;
	}

	// #6: Find any books by the author Bell Hooks and
	// update the author name to be bell hooks (lowercase).
	// I tried using Hash::make. This was not working. Was returning
	// diiferent results even though the values to be hashed where the same
	// So I used sha1(); The reason I am using sha1() is to check for
	// case sensitivty.
	// I guess I just felt like writing a lot of code.
	Public function practice20() {
		$checkAuthor = 'Bell Hooks';
		$checkAuthorHash = sha1($checkAuthor);
		$newAuthor = 'bell hooks';
		$message = '';
		$results = Book::where('author', '=', $checkAuthor)->get();

		if(count($results) > 0):
		    foreach ($results as $key => $result) {
                $currentAuthorHash = sha1($result->author);
			    if($currentAuthorHash == $checkAuthorHash):
				    $book = Book::find($result->id);
				    $book->author = $newAuthor;
				    $book->save();
				    $message = "Match found. $checkAuthor author will be changed to $newAuthor.";
			    else:
				    $message ='No match. Author was not changed.';
			    endif;
		    }
	    else:
		    $message = 'No match. Author was not changed.';
	    endif;
	dump($message);
	}

	#5: Retrieve all the books in descending order according to published date.
	public function practice19() {
		$results = Book::orderBy('published', 'desc')->get();
		dump($results->toArray());
	}

	#4: Retrieve all the books in alphabetical order by title.
	public function practice18() {
		$results = Book::orderby('title')->get();
		dump($results->toArray());
	}

	#3: Retrieve all the books published after 1950.
	public function practice17() {
		$results = Book::where('published', '>', 1950)
		->orderBy('published', 'desc')
		->orderby('title')
		->get();
		dump($results->toArray());
	}

	#2: Retrieve the last 2 books that were added to the books table.
	public function practice16() {
		$results = Book::orderBy('created_at', 'desc')->take(2)->get();
		dump($results->toArray());
	}

	//END exercises for progress week 11

	public function practice15() {
		# First get a book to delete
		$id = 11;
		$book = Book::find($id);

		if (!$book) {
			dump("Did not delete book $id.");
		} else {
			$book->delete();
			dump("Deletion of book $id complete; check the database to see if it worked...");
		}
	}

	public function practice14a() {
		# First get a book to update
		$id = 5;
		$book = Book::find($id);

		if (!$book) {
			dump("Book not found, can't update.");
		} else {
			# Change some properties
			$book->title = 'D Harry Potter and the Sorcerer\'s Stone';

			# Save the changes
			$book->save();

			dump('Update complete; check the database to confirm the update worked.');
		}
	}

	public function practice14() {
		# First get a book to update
		$book = Book::where('author', 'LIKE', '%Scott%')->first();

		if (!$book) {
			dump("Book not found, can't update.");
		} else {
			# Change some properties
			$book->title = 'The Really Greater Gatsby';
			$book->published = '2025';

			# Save the changes
			$book->save();

			dump('Update complete; check the database to confirm the update worked.');
		}
	}

	Public function practice13() {
		$results = Book::where('title', 'LIKE', '%Harry%')
		->where('published', '>=', 1900)
		->orderBy('created_at', 'desc')
		->first();

		dump($results->toArray());
	}

	Public function practice12() {
		$book = new Book();
		$results = $book
		->where('title', 'LIKE', '%Gatsby%')
		->where('published', '>=', 1900)
		->orderBy('created_at', 'desc')
		->get();

		dump($results->toArray());
	}

	Public function practice11() {
		$book = new Book();
		$books = $book
		->where('title', 'LIKE', '%Harry Potter%')
		->orwhere('published', '>=', 1800)
		->orderBy('created_at', 'desc')
		->get();

		dump($books->toArray());
	}

	Public function practice10() {
		$book = new Book();
		$books = $book
		->where('title', 'LIKE', '%Harry Potter%')
		->where('published', '>=', 1998)
		->orderBy('created_at', 'desc')
		->first();

		dump($books->toArray());
	}

	Public function practice9() {
		$book = new Book();
		$books = $book
		->where('title', 'LIKE', '%Harry Potter%')
		->where('published', '>', 1998)
		->get();

		dump($books->toArray());
	}

	Public function practice8() {
		$book = new Book();
		$books = $book->where('title', 'LIKE', '%Harry Potter%')->get();

		dump($books->toArray());
	}

	Public function practice7() {
		$book = new Book();
		$books = $book->all();

		dump($books->toArray());
	}

	Public function practice6() {
		// Instantiate a new Book Model object
		$newBook = new Book();

		// Set properties of book object
		$newBook->title = 'Harry';
		$newBook->title = 'C Harry Potter and the Sorcerer\'s Stone';
		$newBook->author = 'J.K. Rowling';
		$newBook->published = 1997;
		$newBook->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
		$newBook->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';
		$newBook->page_count = 99;
		# Invoke the Eloquent `save` method to generate a new row in the
		# `books` table, with the above data
		$newBook->save();

		dump($newBook->toArray());

	}

	public function show($title = null) {
		dump($title);
		return view('book.show');
	}

	/**
	*
	*/
	public function practice5() {
		// use markdown extra
		$parser = new MarkdownExtra();
		echo $parser->parse('# Hello World');
	}
	/**
	*
	*/
	public function practice4() {
		Debugbar::info($_GET);
		Debugbar::info(['a' => 1, 'b' => 2, 'c' => 3]);
		Debugbar::error('Error!');
		Debugbar::warning('Watch out…');
		Debugbar::addMessage('Another message', 'mylabel');
		return 'Practice 4';
	}

	/**
	*
	*/
	public function practice3() {
		return view('abc');
	}


	/**
	*
	*/
	public function practice2() {
		$email = config('mail');
		dump($email);
	}

	/**
	*
	*/
	public function practice1() {
		dump('This is the first example.');
	}


	/**
	* ANY (GET/POST/PUT/DELETE)
	* /practice/{n?}
	*
	* This method accepts all requests to /practice/ and
	* invokes the appropriate method.
	*
	* http://foobooks.loc/practice/1 => Invokes practice1
	* http://foobooks.loc/practice/5 => Invokes practice5
	* http://foobooks.loc/practice/999 => Practice route [practice999] not defined
	*/
	public function index($n = null) {
		# If no specific practice is specified, show index of all available methods
		if (is_null($n)) {
			foreach (get_class_methods($this) as $method) {
				if (strstr($method, 'practice')) {
					# Echo'ing display code from a controller is typically bad; making an
					# exception here because:
					# 1. This controller is for debugging/demonstration purposes only
					# 2. This controller is introduced before we cover views
					echo "<a href='".str_replace('practice', '/practice/', $method)."'>" . $method . "</a><br>";
				}
			}
			# Otherwise, load the requested method
		} else {
			$method = 'practice'.$n;

			if (method_exists($this, $method)) {
				return $this->$method();
			} else {
				dd("Practice route [{$n}] not defined");
			}
		}
	}
}
