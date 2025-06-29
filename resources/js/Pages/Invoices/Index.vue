<script setup>
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({ invoices: Array });

function send(id) {
    router.patch(`/invoices/${id}/send`);
}

function remove(id) {
    if (confirm('Delete this invoice?')) {
        router.delete(`/invoices/${id}`);
    }
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
                    <Link href="/invoices/create" class="btn">+ New Invoice</Link>
                    <table class="table-auto w-full mt-4">
                        <thead>
                        <tr>
                            <th>Customer</th><th>Title</th><th>Amount</th><th>Status</th><th>Sent</th><th>Due</th><th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="invoice in invoices" :key="invoice.id">
                            <td>{{ invoice.customer.name }}</td>
                            <td>{{ invoice.title }}</td>
                            <td>{{ invoice.amount }}</td>
                            <td>{{ invoice.status }}</td>
                            <td>{{ invoice.sent ? 'Yes' : 'No' }}</td>
                            <td>{{ invoice.due_date }}</td>
                            <td class="flex items-center space-x-2">
                                <Link :href="`/invoices/${invoice.id}/edit`">
                                    <button class="bg-blue-600 text-white px-3 py-1 rounded">
                                        Edit
                                    </button>
                                </Link>
                                <button @click="send(invoice.id)" class="bg-green-600 text-white px-3 py-1 rounded mr-2">Send</button>
                                <button @click="remove(invoice.id)" class="bg-red-600 text-white px-3 py-1 rounded mr-2">Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
