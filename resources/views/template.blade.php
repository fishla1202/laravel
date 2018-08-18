<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        --}}

    </head>
    <body>
        @include('_includes/nav/topnav')
        
        @yield('content')
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
    </body>
</html>
