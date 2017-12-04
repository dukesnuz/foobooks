@php
# Define a PHP array of links and their labels
# Quite a bit of straight PHP code here, but arguably ok
# because it's display specific and allows you to edit the link
# labels without having to edit a logic file.
if(Auth::check()) {
    $nav = [
    'trivia' => 'Trivia',
    'book' => 'Books',
    'book/create' => 'Add a book',
    'search' => 'Search',
    'practice' => 'Practice',
    ];
} else {
    $nav = [
    'register' => 'Register',
    'login' => 'Login',
    ];
}
@endphp

<nav>
    <ul>
        @foreach($nav as $link => $label)
        <li><a href='/{{ $link }}' class='{{ Request::is($link) ? 'active' : '' }}'>{{ $label }}</a>
            @endforeach

            @if(Auth::check())
            <li>
                <form method='POST' id='logout' action='/logout'>
                    {{csrf_field()}}
                    <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                </form>
            </li>
            @endif
        </ul>
    </nav>
