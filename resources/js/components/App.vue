<template>
    <div class="container">
        <div class="row justify-content-end bg-primary">
            <h1 class="col-4 d-flex justify-content-center bg-primary">HN stories</h1>
            <a @click="logout" href="#"
               class="col-4 d-flex justify-content-end text-secondary-emphasis">Log out</a>
        </div>
        <router-link class="link" :to="{ path: '/login'}">login</router-link>
        <router-link class="link" :to="{ path: '/articles'}">articles</router-link>
        <router-link class="link" :to="{ path: '/register'}">register</router-link>
        <!--        <div>fsdfs {{ $validationErrors.value }}</div>-->
        <!--        <div v-if="$validationErrors.length > 0">-->
        <!--            <div class="alert alert-danger">-->
        <!--                <ul>-->
        <!--                    <li v-for="(value, key) in $validationErrors" :key="key">{{ value[0] }}</li>-->
        <!--                </ul>-->
        <!--            </div>-->
        <!--        </div>-->
        <router-view/>


    </div>


</template>
<script setup>


import {RouterView, useRouter} from "vue-router";
import {useStore} from 'vuex'
import axios from 'axios';

const store = useStore()
const router = useRouter();
console.log(store.state.authorized)


async function logout() {

    axios.post('/logout')
        .then(() => {
            console.log("logging out", store.state.isLoggedIn)
            store.commit('LogOut')
            return location.href = '/';
        })
}
</script>
