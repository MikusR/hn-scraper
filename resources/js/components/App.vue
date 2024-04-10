<template>
    <div class="container">
        <div class="row justify-content-end bg-primary">
            <h1 class="col-4 d-flex justify-content-center bg-primary">
                <router-link class="text-decoration-none text-white" :to="{ path: '/articles'}">
                    HN stories
                </router-link>
            </h1>
            <a v-if="store.state.isLoggedIn" @click="logout" href="#"
               class="col-4 d-flex justify-content-end text-secondary-emphasis">Log out</a>
            <router-link v-if="!store.state.isLoggedIn" class="col-4 d-flex justify-content-end text-secondary-emphasis"
                         :to="{ path: '/login'}">login
            </router-link>
        </div>


        <div v-if="store.state.hasErrors">
            <div class="alert alert-danger">
                <ul>
                    <li v-for="(value, key) in store.state.errors" :key="key">{{ value[0] }}</li>
                </ul>
            </div>
        </div>
        <div class="justify-content-center">
            <router-view/>
        </div>


    </div>


</template>
<script setup>


import {RouterView, useRouter} from "vue-router";
import {useStore} from 'vuex'
import axios from 'axios';
import {onBeforeMount} from "vue";

const store = useStore()
const router = useRouter();


onBeforeMount(() => {
    checkLogin(store.state.checkUrl);
})

async function checkLogin(url) {
    try {
        await axios.get(url)
        store.commit('LogIn')
    } catch (error) {
        store.commit('LogOut')
    }
}

async function logout() {
    axios.post('/logout')
        .then(() => {
            store.commit('LogOut')
            router.push({name: 'login'});
        })

}
</script>
