@extends('layouts.master')


@section('title')
    {{ $book->title }}
@endsection


@section('content')
    <h1>{{ $book->title }}</h1>

    <h2>By: {{ $book->author }}</h2>

    <form method='POST' action='/book/{{ $book->id }}/destroy'>
        {{ method_field('put') }}

        {{ csrf_field() }}

        <label for='title'class="btn btn-info">Are you sure you want to delete this book?</label>
        <input type='hidden' name='id' id='id' value='{{ old('id',  $book->id) }}'>

        <input class="btn btn-danger" type='submit' value='Delete' class='btn btn-primary btn-small'>
    </form>

    <a href='/book/' class="btn btn-info">Cancel</a>
@endsection
