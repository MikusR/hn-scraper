require('./bootstrap');
import 'bootstrap';
import {createApp} from 'vue'
import Main from './components/Main'
import Login from './components/Login'


const app = createApp({})
app.component('data-table', Main)
app.component('login', Login)
app.mount('#app')
