<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Hash;

class BookController extends Controller
{
	/**
	* GET /books
	*/
	public function index()
	{
		return App::environment(); # <- This is what we're testing out
		#return 'Here are all the books...';
	}
	/**
	* make Hash
	*/
	public function makeHash()
	{
		return Hash::make('secret');
		//return \Hash::make('secret');
	}
}
