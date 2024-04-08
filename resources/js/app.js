require('./bootstrap');
import 'bootstrap';
import {createApp} from 'vue'
import {createRouter, createWebHistory} from 'vue-router'
import Main from './components/Main'
import Login from './components/Login'
import Register from './components/Register'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'main',
            component: Main
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        }
    ]
})
const app = createApp({})
app.use(router);
app.component('data-table', Main)
app.component('login', Login)
app.mount('#app')
