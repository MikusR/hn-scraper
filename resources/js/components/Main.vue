<template>
    <div class="container">
        <h1 class="text-center bg-primary">HN stories</h1>

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


</script>
<style>

@import 'datatables.net-bs5';
</style>
