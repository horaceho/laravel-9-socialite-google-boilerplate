<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Counter・Home</title>
    </head>
    <body>
        @auth
            Hello {{ Auth::user()->name }} |
            <a href="{{ url('/auth/logout') }}">Logout</a>
        @endauth
        @guest
            Login with <a href="{{ url('/auth/google/redirect') }}">Google</a>
        @endguest
    </body>
</html>
