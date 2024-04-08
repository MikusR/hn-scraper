<template>
    <div class="container">
        <div class="row justify-content-end bg-primary">
            <h1 class="col-4 d-flex justify-content-center bg-primary">HN stories</h1>
            <a @click="logout" href="javascript:void(0)"
               class="col-4 d-flex justify-content-end text-secondary-emphasis">Log
                out</a>
        </div>
        <router-link class="link" :to="{ path: '/login'}">login</router-link>
        <router-link class="link" :to="{ path: '/register'}">register</router-link>
        <router-view>
            <p slot="test-login">log</p>
            <p slot="register">reg</p>

        </router-view>
      

        <DataTable :data="tableData" :columns="tableColumns" :options="options" class="table table-hover table-striped"
                   width="100%">
            <thead>
            <tr>
                <th v-for="column in columns" :key="column"
                    class="">
                    {{ column }}
                </th>
            </tr>
            </thead>
        </DataTable>
    </div>


</template>

<script setup>
import axios from 'axios';
import {onMounted, ref, computed} from 'vue';
import {DataTable} from "datatables.net-vue3";

import DataTablesCore from 'datatables.net-bs5';

DataTable.use(DataTablesCore);

const props = defineProps({
    fetchUrl: {type: String, required: true},
    columns: {type: Array, required: true},
})

const tableData = ref([]);

const options = ref({
    order: [0, 'desc'],
    select: true
});
const tableColumns = ref([
        {data: 'points', width: '10%'},
        {
            data: null,
            render: function (data, type, row, meta) {
                return '<a href="' + row.url + '" target="_blank">' + row.title + '</a>';
            }
        },
        {
            data: 'article_id', width: '10%',
            render: function (data, type, row, meta) {
                return '<a href="https://news.ycombinator.com/item?id=' + data + '" target="_blank">' + data + '</a>';
            }
        },
    ]
);


async function fetchData(url) {
    const response = await axios.get(url)
    if (response.status === 200) {

        tableData.value = response.data;
    }
}

onMounted(() => {
    fetchData(props.fetchUrl);
});

async function logout() {
    axios.post('/logout')
        .then(() => location.href = '/')
}

</script>
<style>

@import 'datatables.net-bs5';
</style>
