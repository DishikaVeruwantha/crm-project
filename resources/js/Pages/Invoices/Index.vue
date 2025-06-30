<script setup>
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Swal from "sweetalert2";

defineProps({ invoices: Array });

function send(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will send the invoice to the customer.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#71edb6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, send it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.patch(`/invoices/${id}/send`, {}, {
                onSuccess: () => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Invoice Sent!',
                        text: 'The invoice was successfully sent.',
                    });
                }
            });
        }
    });
}

function remove(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action can't be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/invoices/${id}`);
        }
    })
}
</script>

<template>
    <Head title="Invoices" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold text-gray-800">Invoices</h2>
        </template>

        <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <Link
                    href="/invoices/create"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow transition"
                >
                    + New Invoice
                </Link>
            </div>

            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Customer
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Title
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Amount
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Status
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Sent
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Due Date
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Actions
                        </th>
                    </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr
                        v-for="invoice in invoices"
                        :key="invoice.id"
                        class="hover:bg-gray-50 transition"
                    >
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ invoice.customer.name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ invoice.title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-right font-semibold">
                            ${{ Number(invoice.amount).toFixed(2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span
                                    :class="{
                                        'inline-flex px-2 py-1 text-xs font-semibold rounded-full':
                                            true,
                                        'bg-green-100 text-green-800': invoice.status === 'paid',
                                        'bg-yellow-100 text-yellow-800': invoice.status === 'pending',
                                        'bg-red-100 text-red-800': invoice.status === 'overdue',
                                        'bg-gray-100 text-gray-800': !['paid', 'pending', 'overdue'].includes(invoice.status),
                                    }"
                                >
                                    {{ invoice.status.charAt(0).toUpperCase() + invoice.status.slice(1) }}
                                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700">
                            {{ invoice.sent ? 'Yes' : 'No' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700">
                            {{ invoice.due_date }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end space-x-2">
                            <Link
                                :href="`/invoices/${invoice.id}/edit`"
                                class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition"
                                title="Edit"
                            >
                                ✏️ Edit
                            </Link>

                            <button
                                @click="send(invoice.id)"
                                :disabled="invoice.sent"
                                class="inline-flex items-center px-3 py-1 rounded-md transition
                                text-white
                                bg-green-600 hover:bg-green-700
                                disabled:bg-gray-400 disabled:cursor-not-allowed"
                                title="Send"
                            >
                                {{ invoice.sent ? '✅ Sent' : '📤 Send' }}
                            </button>

                            <button
                                @click="remove(invoice.id)"
                                class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md transition"
                                title="Delete"
                            >
                                🗑 Delete
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
