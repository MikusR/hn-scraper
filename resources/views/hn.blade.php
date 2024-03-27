<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/vue@3"></script>
</head>
<body>
<div id="app">
    <p>
        <input type="text" v-model="sveiciens">
    </p>
    @{{ sveiciens }} @{{ sveiciens.length }}
</div>
<script>


    Vue.createApp({
        data() {
            return {
                sveiciens: "Hello mikus"
            };
        },
        mounted() {
            setTimeout(() => {
                this.sveiciens = "Hello daugiau"
            }, 3000)
        }
    }).mount('#app');
</script>
{{--<script src="{{ mix('js/app.js') }}"></script>--}}
</body>
</html>
