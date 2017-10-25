<?php
Route::get('/env', function () {
    dump(config('app.name'));
    dump(config('app.env'));
    dump(config('app.debug'));
    dump(config('app.url'));
});

/**
* Practice
*/
Route::get('/practice/6', 'PracticeController@practice6');
Route::any('/practice/{n?}', 'PracticeController@index');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
* My practice foobooks App
*/
// Using index
// not working
//Route::get('/', 'WelcomeController@index');

// Using __invoke()
// not working
//Route::get('/', 'WelcomeController');
/*
Route::get('book/{id}/', function ($id) {
    return 'You have requested book # '.$id;
});
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/
// New routes
Route::get('/example', function () {
    return 'Hello David!';
});

/**
* Book
*/
Route::get('/book/create', 'BookController@create');
Route::post('/book', 'BookController@store');

Route::get('/book/', 'BookController@index');
Route::get('/book/{title}', 'BookController@show');

Route::get('/search', 'BookController@search');

Route::get('/hash/', 'BookController@makeHash');
Route::get('/date/', 'BookController@getDate');
Route::get('/timezone/', 'BookController@getTimezone');
Route::get('/show/{title}', 'PracticeController@show');



/**
* Example portion of Foobooks that mirrors what you'll do for P3
*/
Route::get('/trivia/', 'TriviaController@index');
Route::get('/trivia/check-answer', 'TriviaController@checkAnswer');
/**
* Homepage
*/
Route::get('/', 'WelcomeController');
