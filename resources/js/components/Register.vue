<template>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row">


            <form action="javascript:void(0)" @submit.prevent="register">

                <div class="mb-3 from-orange-300">
                    <label class="form-label" for="name">Name</label>
                    <input class="form-control" type="text" v-model="auth.name" name="name" id="name" size="50">
                </div>
                <div class="mb-3 from-orange-300">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="text" v-model="auth.email" name="email" id="email" size="50">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" type="password" v-model="auth.password" name="password"
                           id="password">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Password again</label>
                    <input class="form-control" type="password" v-model="auth.password_confirmation"
                           name="password_confirmation"
                           id="password_confirmation">
                </div>

                <button type="submit" :disabled="processing" class="btn btn-primary ">
                    {{ processing ? "Please wait" : "Register" }}
                </button>


            </form>
            <div class="mb-3">
                <label>Already have an account?
                    <router-link :to="{ name: 'login' }">login!</router-link>
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
    name: 'register',
})
const auth = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: ""
})

const processing = ref(false)
onMounted(() => {
    store.commit('ClearErrors');
})

async function register() {
    processing.value = true

    await axios.get('/sanctum/csrf-cookie')
    await axios.post('/register', auth.value)
        .then(({data}) => {
            store.dispatch('checkLogin')
            store.commit('ClearErrors')
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
