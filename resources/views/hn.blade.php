<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="min-h-screen grid place-items-center">
<div id="app">
    <section>
        <h2 class="font-bold mb-2">tasks</h2>
        <ul>
            <li v-for="task in assignments">@{{ task.name }}</li>
        </ul>

    </section>
    <button class="bg-green-500 rounded" @click="sendRequest">Send Request</button>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
