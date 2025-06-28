<script setup>
import {Link, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    phone: ''
});

function submit() {
    form.post('/customers');
}
</script>

<template>
    <Head title="Customers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customers</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="text-2xl font-bold mb-4">Create Customer</h1>
                    <form @submit.prevent="submit">
                        <input v-model="form.name" placeholder="Name" />
                        <input v-model="form.email" placeholder="Email" />
                        <input v-model="form.phone" placeholder="Phone" />
                        <button type="submit" class="btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
