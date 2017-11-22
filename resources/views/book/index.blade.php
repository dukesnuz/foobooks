@extends('layouts.master')

@push('head')
    <link href='/css/book.css' rel='stylesheet'>
@endpush

@section('title')
    All books
@endsection

@section('content')

    <div class='newBooks' style='background-color: yellow'>
        <h1> New Books to Library</h1>
        @foreach($newBooks as $title => $book)
            <div class='book cf'>
                <img src='{{ $book['cover'] }}' class='cover' alt='Cover image for {{ $book['title'] }}'>
                <h2>{{ $book['title'] }}</h2>
                <p>By {{ $book['author'] }}</p>
                <a href='/book/{{ kebab_case($book['title']) }}'>View</a>
            </div>
        @endforeach
    </div>
    <h1>All books</h1>

    @foreach($books as $title => $book)
        <div class='book cf'>
            <img src='{{ $book['cover'] }}' class='cover' alt='Cover image for {{ $book['title'] }}'>
            <h2>{{ $book['title'] }}</h2>
            <p>By {{ $book['author'] }}</p>
            <a href='/book/{{ kebab_case($book['title']) }}'>View</a>
        </div>
    @endforeach

@endsection
