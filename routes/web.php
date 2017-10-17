<?php
Route::get('/env', function () {
    dump(config('app.name'));
    dump(config('app.env'));
    dump(config('app.debug'));
    dump(config('app.url'));
});

/**
* PracticeController
*/
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
