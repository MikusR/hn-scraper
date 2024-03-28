<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/vue@3"></script>
</head>
<body class="min-h-screen grid place-items-center">
<div id="app">
    <section>
        <h2 class="font-bold mb-2">tasks to do</h2>
        <ul>
            <li v-for="task in assignments.filter(a => !a.complete)" :key="task.id">
                <label>@{{ task.name }}
                    <input type="checkbox" v-model="task.complete">
                </label>

            </li>
        </ul>

    </section>
    <section v-if="assignments.filter(a => a.complete).length" class="mt-8">
        <h2 class="font-bold mb-2">Finisht tasks</h2>
        <ul>
            <li v-for="task in assignments.filter(a => a.complete)" :key="task.id">
                <label>@{{ task.name }}
                    <input type="checkbox" v-model="task.complete">
                </label>

            </li>
        </ul>

    </section>
    <pre>
        @{{ assignments }}
    </pre>
    <button class="bg-green-500 rounded" @click="sendRequest">Send Request</button>

</div>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    let app = {
        data() {
            return {
                assignments: [
                    {name: 'task 1', complete: false, id: 1},
                    {name: '2. task', complete: false, id: 2},
                    {name: 'task number 3', complete: false, id: 3},
                    {name: '4th task', complete: false, id: 4}
                ],
            }
        },
        methods: {
            sendRequest() {
                axios.get('/api/v0/last').then((response) => {
                    console.log(response.data.title);
                });
            }
        },

        mounted() {
            this.sendRequest();
        }
    }


    Vue.createApp(app).mount("#app");
</script>

</body>
</html>
