<template>
    <div class="container">

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

import {DataTable} from "datatables.net-vue3";
import DataTablesCore from 'datatables.net-bs5';

import axios from 'axios';

import {onBeforeMount, onMounted, ref} from 'vue';
import {useRouter} from 'vue-router';
import {useStore} from "vuex";

const store = useStore()
const props = defineProps({
    fetchUrl: {type: String, required: true},
})
DataTable.use(DataTablesCore);

const columns = ['points', 'title', 'article_id']
const tableData = ref([]);
const router = useRouter();
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
    try {
        const response = await axios.get(url)
        tableData.value = response.data;
    } catch (error) {
        if (error.response && error.response.status === 401) {
            await router.push({name: 'login'})

        } else {
            console.error('Error:', error.message);
        }
    }

}


onMounted(() => {

    if (store.getters.isLoggedIn) {
        fetchData(props.fetchUrl);
    } else router.push({name: 'login'})

});
console.log("articles.vue", store.getters.isLoggedIn)

</script>
<style>

@import 'datatables.net-bs5';
</style>
