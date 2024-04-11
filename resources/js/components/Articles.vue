<template>
    <div class="container">

        <DataTable ref="hntable" :data="tableData" :columns="tableColumns" :options="options"
                   class="table table-hover table-striped"
                   width="100%">
            <thead>
            <tr>
                <th v-for="column in columns" :key="column"
                    class="">
                    {{ column }}
                </th>
            </tr>
            </thead>
            <button class="btn btn-danger btn-sm" @click="deleteSelectedRows">Delete Selected Rows</button>

        </DataTable>

    </div>


</template>

<script setup>

import {DataTable} from "datatables.net-vue3";
import DataTablesCore from 'datatables.net-bs5';
import 'datatables.net-select-bs5';

import axios from 'axios';

import {onMounted, ref} from 'vue';
import {useRouter} from 'vue-router';
import {useStore} from "vuex";

const store = useStore()
const router = useRouter();

const props = defineProps({
    fetchUrl: {type: String, required: true},
})
DataTable.use(DataTablesCore);

const columns = ['points', 'title', 'posted']
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
            data: null, width: '14%',
            render: function (data, type, row, meta) {
                return '<a href="https://news.ycombinator.com/item?id=' + row.article_id + '" target="_blank">' + row.date + '</a>';
            }
        },
    ]
);
const hntable = ref();
let dt;


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

async function deleteSelectedRows() {
    if (confirm("Do you really want to delete?")) {
        try {
            dt.rows({selected: true}).every(function () {
                let idx = tableData.value.indexOf(this.data());
                tableData.value.splice(idx, 1);
                axios.delete('/api/v0/delete-link/' + this.data().article_id)
            })

        } catch (error) {
            console.error('Error:', error.message);
        }
    }

}

onMounted(() => {
    fetchData(props.fetchUrl);
    dt = hntable.value.dt;
});


</script>
<style>

@import 'datatables.net-bs5';
@import 'datatables.net-select-bs5';
</style>
