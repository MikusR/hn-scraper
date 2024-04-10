import axios from "axios";

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
            hasErrors: false,
            errors: {},
            message: "",
            checkUrl: document.getElementById('app').getAttribute('data-check-url'),
            user: {name: null}
        }
    },
    mutations: {
       
        SetUserName(state, name) {
            state.user.name = name
        },
        LogOut(state) {
            state.user.name = null
        },
        ClearErrors(state) {
            state.hasErrors = false
            state.message = ""
            state.errors = {}
        },
        SetErrors(state, errors) {
            state.hasErrors = true
            state.errors = errors
        },
        SetMessage(state, message) {
            state.hasErrors = true
            state.message = message
        },
        SetCheckUrl(state, url) {
            state.checkUrl = url
        }
    },
    getters: {
        isLoggedIn(state) {
            return state.user.name !== null;
        }
    },
    actions: {
        async checkLogin(context) {
            try {
                await axios.get(context.state.checkUrl).then(({data}) => {
                    context.commit('SetUserName', data.name)
                })

            } catch (error) {
                context.commit('LogOut')
            }
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
