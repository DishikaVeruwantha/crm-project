<script setup>
import {Link, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({customers: Array});

const form = useForm({
    customer_id: '',
    title: '',
    amount: '',
    due_date: '',
    status: 'unpaid',
});

function submit() {
    form.post('/invoices');
}
</script>

<template>
    <Head title="Invoices" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoices</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="text-2xl font-bold mb-4">Create Invoice</h1>
                    <form @submit.prevent="submit">
                        <select v-model="form.customer_id">
                            <option v-for="c in customers" :value="c.id" :key="c.id">{{ c.name }}</option>
                        </select>
                        <input v-model="form.title" type="text" placeholder="Title" />
                        <input v-model="form.amount" type="number" placeholder="Amount" />
                        <input v-model="form.due_date" type="date" />
                        <select v-model="form.status">
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                        </select>
                        <button class="btn">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
