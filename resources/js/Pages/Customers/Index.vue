<script setup>
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({ customers: Array });

function toggleStatus(id) {
    if (confirm('Change customer status?')) {
        router.patch(route('customers.toggleStatus', id));
    }
}

function deleteCustomer(id) {
    if (confirm('Are you sure?')) {
        router.delete(`/customers/${id}`);
    }
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
                    <Link href="/customers/create" class="btn">+ New Customer</Link>
                    <table class="table-auto w-full mt-4">
                        <thead>
                        <tr>
                            <th>Name</th><th>Email</th><th>Phone</th><th>Status</th><th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="customer in customers" :key="customer.id">
                            <td>{{ customer.name }}</td>
                            <td>{{ customer.email }}</td>
                            <td>{{ customer.phone }}</td>
                            <td>{{ customer.status ? 'Active' : 'Inactive' }}</td>
                            <td class="flex items-center space-x-2">
                                <Link :href="`/customers/${customer.id}/edit`">
                                    <button class="bg-blue-600 text-white px-3 py-1 rounded">
                                        Edit
                                    </button>
                                </Link>
                                <form :action="`/customers/${customer.id}`" method="post" @submit.prevent="deleteCustomer(customer.id)">
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded mr-2">Delete</button>
                                </form>
                                <button @click="toggleStatus(customer.id)" class="bg-yellow-500 text-white px-2 py-1 rounded mr-2">
                                    Toggle Status
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
