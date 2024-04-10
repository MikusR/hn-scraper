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


        <router-view/>


    </div>


</template>
<script setup>


import {RouterView, useRouter} from "vue-router";
import axios from 'axios';

const router = useRouter();

async function logout() {
    axios.post('/logout')
        .then(() => location.href = '/')
}
</script>
