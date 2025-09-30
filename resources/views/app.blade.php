<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hn-scraper</title>
    @vite('resources/sass/app.scss')


</head>
<body class="min-h-screen grid">
<div id="app"
     data-url="{{ route('index') }}"
     data-check-url="{{ route('check') }}">
</div>
@vite('resources/js/app.js')
</body>
</html>
