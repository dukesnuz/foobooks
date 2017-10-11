<?php

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
//Route::get('/', 'WelcomeController@index');

// Using __invoke()
Route::get('/', 'WelcomeController');

/*
Route::get('/', function () {
    return view('welcome');
});
*/
// New routes
Route::get('/example', function () {
    return 'Hello David!';
});
/*
Route::get('/books', function() {
return 'Here are all the books...';
});
*/
Route::get('/book/', 'BookController@index');
Route::get('/book/{title}', 'BookController@show');
Route::get('/hash/', 'BookController@makeHash');
Route::get('/date/', 'BookController@getDate');
Route::get('/timezone/', 'BookController@getTimezone');
/*
Route::get('/book/{title?}', function($title = '') {

    if ($title == '') {
        return 'Your request did not include a title.';
    } else {
        return 'Results for the book: '.$title;
    }

});
*/
