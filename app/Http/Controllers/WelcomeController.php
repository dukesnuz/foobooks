<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/*
* If controller has only one job can use __invoke do not have to
* name action ie index()
*/

class WelcomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome');
    }
}
