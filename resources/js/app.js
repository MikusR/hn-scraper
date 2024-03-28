require('./bootstrap');
import 'bootstrap';
import {createApp} from 'vue'
import Main from './components/Main'


const app = createApp({})
app.component('data-table', Main)

app.mount('#app')
