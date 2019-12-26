<?php

namespace App\Facades;

class Number
{
    /*If Number class called and method called is not in
    *this file then the below static function will be called
    */
    public static function __callStatic($method, $argumnets)
    {
        dd("$method is not a method in this class");
    }

    public static function randomNumber()
    {
        dd(substr(time() . mt_rand(1, 100000), 6, 9));
    }

    public static function epoch()
    {
        dd(time());
    }
}
