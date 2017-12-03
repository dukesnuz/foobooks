<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    public function author()
    {
        # Book belongs to Author
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Author');
    }

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
