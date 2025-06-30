<script setup>
import dayjs from 'dayjs';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({ transactions: Array });
</script>

<template>
    <Head title="Transactions" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold text-gray-800">Transactions</h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-500 text-white">
                    <tr>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                        >
                            ID
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                        >
                            Invoice Title
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                        >
                            Customer
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                        >
                            Amount
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                        >
                            Date
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr
                        v-for="tx in transactions"
                        :key="tx.id"
                        class="hover:bg-gray-50 transition duration-150"
                    >
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ tx.id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ tx.invoice.title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ tx.invoice.customer.name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ Number(tx.amount).toFixed(2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ dayjs(tx.created_at).format('YYYY-MM-DD HH:mm') }}
                        </td>
                    </tr>
                    <tr v-if="transactions.length === 0">
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 text-sm">
                            No transactions found.
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
