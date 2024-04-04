<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hn-scraper</title>


</head>
<body>
<div id="app">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
        <login/>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
