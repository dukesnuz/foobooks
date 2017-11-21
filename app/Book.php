<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /*
    * Dump essential details of book onto the page
    */
    public static function dump($books = null)
    {
        $data = [];

        if (is_null($books)) {
            $books = self::all();
        }

        foreach ($books as $book) {
            $data[] = $book->title.' by '.$book->author;
        }
        dump($data);
    }

}
