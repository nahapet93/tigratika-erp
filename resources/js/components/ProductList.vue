<script setup>
import {ref} from "vue";
import axios from "axios";
import MoveButton from "@/components/MoveButton.vue";

const products = ref([]);
let smallestPosition;
let biggestPosition;

function load() {
    axios.get('/api/products')
        .then(response => {
            products.value = response.data.data.map(product => ({...product, open: false}));
            const positions = products.value.map(product => product.position).sort();
            [smallestPosition, biggestPosition] = [positions[0], positions[positions.length - 1]]
        });
}

load();

function openClose(product) {
    product.open = !product.open;
}

function moveUp(id) {
    axios.put(`/api/products/move-up/${id}`)
        .then(response => {
            if (response.status === 200) {
                load();
            }
        });
}

function moveDown(id) {
    axios.put(`/api/products/move-down/${id}`)
        .then(response => {
            if (response.status === 200) {
                load();
            }
        });
}

function remove(id) {
    if (confirm("Are you sure you want to delete?")) {
        axios.delete(`/api/products/${id}`)
            .then(response => {
                if (response.status === 200) {
                    load();
                }
            });
    }
}

</script>

<template>
    <div class="card-body">
        <div v-if="products.length">
            <table class="border-collapse table-auto w-full">
                <thead>
                <tr>
                    <th></th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Источник</th>
                    <th>Лазер</th>
                    <th>Сварка</th>
                    <th>Сборка</th>
                    <th>Электро</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <template v-for="product in products" :key="product.id">
                    <tr :class="{'cursor-pointer': product.children.length}" @click="openClose(product)">
                        <td>
                            <MoveButton @moveUp="moveUp(product.id)"
                                        @moveDown="moveDown(product.id)"
                                        :position="product.position"
                                        :smallestPosition="smallestPosition"
                                        :biggestPosition="biggestPosition"
                            ></MoveButton>
                        </td>
                        <td>{{ product.name }}
                            <button v-if="product.children.length">{{ product.open ? '⬇️' : '➡️' }}</button>
                        </td>
                        <td>{{ product.amount }}</td>
                        <td>{{ product.source }}</td>
                        <td>{{ product.laser }}</td>
                        <td>{{ product.welding }}</td>
                        <td>{{ product.assembly }}</td>
                        <td>{{ product.electricity }}</td>
                        <td>
                            <button>🔍</button>
                        </td>
                        <td>
                            <button @click.stop="remove(product.id)">🗑️</button>
                        </td>
                    </tr>
                    <template v-if="product.children.length" v-for="child in product.children" :key="child.id">
                        <tr class="border-2" :class="{'hidden' : !product.open}">
                            <td></td>
                            <td class="p-2">{{ child.name }}</td>
                            <td>{{ child.amount }}</td>
                            <td>{{ child.source }}</td>
                            <td>{{ child.laser }}</td>
                            <td>{{ child.welding }}</td>
                            <td>{{ child.assembly }}</td>
                            <td>{{ child.electricity }}</td>
                        </tr>
                    </template>
                </template>
                </tbody>
            </table>
        </div>
        <div v-if="!products.length" class="text-center">
            <h5 class="card-header text-center">Nothing found</h5>
        </div>
    </div>
</template>

<style scoped>

</style>
