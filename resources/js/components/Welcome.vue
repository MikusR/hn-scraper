<template>
    <h1>Hello, {{ user ? user.title : 'World' }}</h1>
    <button
        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        @click="sendRequest">Send Request
    </button>
</template>
<script setup>
import axios from 'axios';
import {ref} from 'vue';

const user = ref();

async function sendRequest() {
    const response = await axios.get('/api/v0/first')

    if (response.status === 200) {
        user.value = response.data;
    }
}
</script>
