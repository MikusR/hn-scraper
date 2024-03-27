require('./bootstrap');

import Vue, {createApp} from 'vue';

let app = {
    data() {
        return {
            assignments: [
                {name: 'task 1', complete: false},
                {name: '2. task', complete: false},
                {name: 'task number 3', complete: false},
                {name: '4th task', complete: false}
            ],
        }
    },
    methods: {
        sendRequest() {
            axios.get('/api/v0/last').then((response) => {
                console.log(response.data.title);
            });
        }
    }
}
createApp(app).mount('#app');


