<template>

    <div class="container">
        <div>{{ store.state.isLoggedIn }}</div>
        <form action="javascript:void(0)" class="row" @submit.prevent="login">

            <div class="form-row from-orange-300">
                <label for="email">Email</label>
                <input type="text" v-model="auth.email" name="email" id="email">
            </div>
            <div class="form-row">
                <label for="password">Password</label>
                <input type="password" v-model="auth.password" name="password" id="password">
            </div>
            <div class="form-row">
                <button type="submit" :disabled="processing" class="btn btn-primary btn-block">
                    {{ processing ? "Please wait" : "Login" }}
                </button>
            </div>
            <div>
                <label>Don't have an account?
                    <router-link :to="{ name: 'register' }">register!</router-link>

                </label>
            </div>
        </form>
    </div>

</template>
<script setup>
import axios from "axios";
import {ref} from "vue";
import {useRouter} from 'vue-router'
import {useStore} from 'vuex'

const store = useStore()
const router = useRouter()
defineOptions({
    name: 'login',
})
const auth = ref({
    email: "",
    password: ""
})

const processing = ref(false)


async function login() {
    processing.value = true

    await axios.get('/sanctum/csrf-cookie')
    await axios.post('/login', auth.value).then(({data}) => {
    }).catch(({response}) => {
        if (response.status === 422) {
            alert(response.data.message)
            // this.$validationErrors.value = response.data.errors
        } else {
            // this.$validationErrors.value = {}
            alert(response.data.message)
        }
    }).finally(() => {
        processing.value = false
        store.commit('LogIn')
        router.push({name: 'articles'})

    })
}

</script>
