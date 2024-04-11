<template>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row">


            <form action="javascript:void(0)" @submit.prevent="login">

                <div class="mb-3 from-orange-300">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="text" v-model="auth.email" name="email" id="email" size="50">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" type="password" v-model="auth.password" name="password"
                           id="password">
                </div>

                <button type="submit" :disabled="processing" class="btn btn-primary ">
                    {{ processing ? "Please wait" : "Login" }}
                </button>


            </form>
            <div class="mb-3">
                <label>Don't have an account?
                    <router-link :to="{ name: 'register' }">register!</router-link>

                </label>
            </div>

        </div>
    </div>

</template>
<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
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
onMounted(() => {
    store.commit('ClearErrors');
})
const processing = ref(false)

async function login() {
    processing.value = true

    await axios.get('/sanctum/csrf-cookie')
    await axios.post('/login', auth.value)
        .then(() => {
            store.commit('ClearErrors')
            store.dispatch('checkLogin')
            router.push({name: 'articles'})
        })
        .catch(({response}) => {
            if (response.status === 422) {
                store.commit('SetErrors', response.data.errors)
            }
            if (response.status === 429) {
                store.commit('SetMessage', "too many connections. please try again later")
            } else {
                store.commit('SetMessage', response.data.message)
            }
        })
        .finally(() => {
            processing.value = false
        })


}

</script>
