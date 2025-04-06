<template>
    <div class="container">
        <div class="row justify-content-end bg-primary">
            <h1 class="col-4 d-flex justify-content-center bg-primary">
                <router-link class="text-decoration-none text-white" :to="{ path: '/articles'}">
                    HN stories
                </router-link>
            </h1>
            <a v-if="store.getters.isLoggedIn" @click="logout" href="#"
               class="col-4 d-flex justify-content-end text-secondary-emphasis">
                Log out ({{ store.state.user.name }})</a>
            <router-link v-if="!store.getters.isLoggedIn"
                         class="col-4 d-flex justify-content-end text-secondary-emphasis"
                         :to="{ path: '/login'}">login
            </router-link>
        </div>


        <div v-if="store.state.hasErrors">
            <div class="alert alert-danger">
                <h5>{{ store.state.message }}</h5>
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
import {onMounted} from "vue";

const store = useStore()
const router = useRouter();


onMounted(() => {
    store.commit('ClearErrors');

    store.dispatch('checkLogin')
})
if (store.getters.isLoggedIn) {
    router.push({name: 'articles'})
}

async function logout() {
    axios.post('/logout')
        .then(() => {
            store.commit('LogOut')
            router.push({name: 'login'});
        })

}
</script>
