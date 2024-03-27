<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/vue@3"></script>
    <style>
        html, body {
            height: 100%;
        }

        body {
            display: grid;
            place-items: center;
        }

        .text-red {
            color: red;
        }

        .text-green {
            color: green;
        }
    </style>
</head>
<body>
<div id="app">
    <button v-bind:class="buttonClasses">test button</button>

</div>
<script>


    Vue.createApp({
        data() {
            return {
                buttonClasses: 'text-green'
            };
        }


    }).mount('#app');
</script>
{{--<script src="{{ mix('js/app.js') }}"></script>--}}
</body>
</html>
