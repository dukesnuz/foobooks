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

Route::get('/', function () {
    return view('welcome');
});

// New routes
Route::get('/example', function () {
    return 'Hello David!';
});
/*
Route::get('/books', function() {
return 'Here are all the books...';
});
*/

Route::get('/books', 'BookController@index');

Route::get('hash', 'BookController@makeHash');

Route::get('/book/{title?}', function($title = '') {

    if($title == '') {
        return 'Your request did not include a title.';
    }
    else {
        return 'Results for the book: '.$title;
    }

});
