require('./bootstrap');
import 'bootstrap';
import {createApp, ref} from 'vue'
import {createRouter, createWebHistory} from 'vue-router'
import App from './components/App.vue'
import Articles from './components/Articles'
import Login from './components/Login'
import Register from './components/Register'
import {createStore} from 'vuex'

const url = document.getElementById('app').getAttribute('data-url')
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
            component: Articles,
            props: {fetchUrl: url}
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        }
    ]
})
const store = createStore({
    state() {
        return {
            isLoggedIn: false
        }
    },
    mutations: {
        LogIn(state) {
            state.isLoggedIn = true
        },
        LogOut(state) {
            state.isLoggedIn = false
        }
    }
})

const app = createApp(App)
app.use(store)
app.use(router);
app.component('articles', Articles)
app.component('login', Login)
app.component('register', Register)
app.mount('#app')
