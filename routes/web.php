<?php

Route::get('/env', function () {
    dump(config('app.name'));
    dump(config('app.env'));
    dump(config('app.debug'));
    dump(config('app.url'));
});

/*** added to create a Facade***/
// random number method is invoked
Route::get('random-number', function () {
    return Number::randomNumber();
});

// epoch method is invoked
Route::get('epoch-time', function () {
    return Number::epoch();
});

// If the method does not exist, then the PHP magic method is invoked
Route::get('does-not-exist', function () {
    return Number::doesNotExist();
});

/**
* Practice
*/
Route::get('/practice/6', 'PracticeController@practice6');
Route::any('/practice/{n?}', 'PracticeController@index');

// practice shorten url
// https://github.com/Waavi/url-shortener
Route::get('/pracitce/33', 'PracticeController@shortenUrl');
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

Route::get('book/{id}/', function ($id) {
    return 'You have requested book # '.$id;
});


/*
Route::get('/', function () {
return view('welcome');
});
*/
// New routes
/*
Route::get('/example', function () {
    return 'Hello David!';
});
*/
/**
* Book
*/
//Route::get('/book/create', 'BookController@create');
Route::get('/book/create', [
    'middleware' => 'auth',
    'uses' => 'BookController@create'
]);
Route::group(['middleware' => 'auth'], function () {
    Route::post('/book', 'BookController@store');

    # Show form to edit specific book
    Route::get('/book/{id}/edit', 'BookController@edit');
    # Process form to edit a specific book
    Route::put('/book/{id}', 'BookController@update');

    # Show book to be deleted
    Route::get('/book/{id}/delete', 'BookController@delete');
    # Process form to delete a specific book
    Route::put('/book/{id}/destroy', 'BookController@destroy');

    Route::get('/book/', 'BookController@index');
    Route::get('/book/{id}', 'BookController@show');

    Route::get('/search', 'BookController@search');
});

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


Route::get('/debug', function () {
    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    $debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});

Auth::routes();

// verify registration a success

Route::get('/show-login-status', function () {
    $user = Auth::user();

    if ($user) {
        dump('You are logged in.', $user->toArray());
    } else {
        dump('You are not logged in.');
    }

    return;
});
/**********************************
* Using vuejs
*/
Route::get('/vue', function () {
    return view('vue-practice');
});
Route::get('/display', function () {
    return view('vue-practice');
});

Route::get('/getbooks', 'BookController@getBooks');

/***praticing phpunit*****/
