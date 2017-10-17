<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Hash;
use Config;
use Carbon\Carbon;

class BookController extends Controller
{
	/**
	* GET /books
	*/
	public function index()
	{
		#return App::environment(); # <- This is what we're testing out
		return 'Here are all the books...';
	}

	public function show($title = null)
	{
		return view('book.show')->with(['title' => $title]);
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
