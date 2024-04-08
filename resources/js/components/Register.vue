<template>
    <div class="container">
        <h2>register</h2>
        <form action="javascript:void(0)" class="row" @submit.prevent="login">
            <div v-if="Object.keys(validationErrors).length > 0">
                <div class="alert alert-danger">
                    <ul>
                        <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                    </ul>
                </div>
            </div>
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
                    <router-link :to="{ name: 'main' }">main!</router-link>
                    <router-link :to="{ name: 'register' }">register!</router-link>

                </label>
            </div>
        </form>
    </div>

</template>
<script setup>

</script>
