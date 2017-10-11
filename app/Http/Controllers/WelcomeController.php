<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
class WelcomeController extends Controller
{

public function index()
{
return view('Welcome');
}
}
*/
/*
* If controller has only one job can use __invoke do not have to
* name action ie index() above
*/

class WelcomeController extends Controller
{
    public function __invoke()
    {
        return view('Welcome');
    }
}
