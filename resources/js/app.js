require('./bootstrap');
import 'bootstrap';
import {createApp} from 'vue'
import {createRouter, createWebHistory} from 'vue-router'
import App from './components/App.vue'
import Articles from './components/Articles'
import Login from './components/Login'
import Register from './components/Register'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: '/login'
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/articles',
            name: 'articles',
            component: Articles
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        }
    ]
})
const app = createApp(App)
app.use(router);
app.component('articles', Articles)
app.component('login', Login)
app.component('register', Register)
app.mount('#app')
