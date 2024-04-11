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
            <button class="btn btn-danger" @click="deleteSelectedRows">Delete Selected Rows</button>
            <div>
            <pre>
                {{ selectedRows }}
            </pre>
            </div>
        </DataTable>

    </div>


</template>

<script setup>

import {DataTable} from "datatables.net-vue3";
import DataTablesCore from 'datatables.net-bs5';

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

const columns = ['points', 'title', 'article_id']
const tableData = ref([]);
const selectedRows = ref([]);
const options = ref({
    order: [1, 'desc'],
    select: true
});
const tableColumns = ref([
        {
            data: 'article_id',
            render: function (data, type, row, meta) {
                return '<input type="checkbox" name="arow" v-model="selectedRows" :value="' + data + '">';
            }, width: '1%'
        },
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
    try {
        // const test = dt.rows({selected: true}).data();
        dt.rows({selected: true}).every(function () {
            console.log(this.data().article_id)

        });
        // test.forEach(item => {
        //     selectedRows.value.push(item.article_id);
        // })
        // console.log(selectedRows);
        // console.log(selectedRows);
        // const response = await axios.post('/api/delete-rows', { rows: this.selectedRows });
        // console.log(response.data);
        // Remove deleted rows from the local data
        // tableData.value = tableData.value.filter(item => !this.selectedRows.includes(item.id));
        // Clear selectedRows array
        // selectedRows.value = [];
    } catch (error) {
        console.error('Error:', error.message);
    }
}

onMounted(() => {
    fetchData(props.fetchUrl);
    dt = hntable.value.dt;
});


</script>
<style>

@import 'datatables.net-bs5';
</style>
