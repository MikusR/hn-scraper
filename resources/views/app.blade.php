<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--    <link href="https://cdn.datatables.net/2.0.3/css/dataTables.tailwindcss.css" rel="stylesheet">--}}
    {{--    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.tailwindcss.js"></script>--}}

</head>
<body class="min-h-screen grid">
<div id="app">
    <data-table fetch-url="{{ route('index') }}"
                :columns="['points','title', 'article_id']"></data-table>

</div>
<script src="{{ mix('js/app.js') }}"></script>


</body>
</html>
