<script setup>
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

defineProps({ customers: Array });

function toggleStatus(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to change the status of this customer.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#7b4bcd',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, change it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.patch(route('customers.toggleStatus', id));
        }
    })
}
// Function to confirm delete
function deleteCustomer(id) {
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
            router.delete(`/customers/${id}`);
        }
    })
}
</script>

<template>
    <Head title="Customers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold text-gray-800">Customers</h2>
        </template>

        <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <Link
                    href="/customers/create"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow transition"
                >
                    + New Customer
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
                            Name
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Email
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Phone
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Status
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
                        v-for="customer in customers"
                        :key="customer.id"
                        class="hover:bg-gray-50 transition"
                    >
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ customer.name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ customer.email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ customer.phone }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    :class="{
                                        'inline-flex px-2 text-xs leading-5 font-semibold rounded-full':
                                            true,
                                        'bg-green-100 text-green-800': customer.status,
                                        'bg-red-100 text-red-800': !customer.status,
                                    }"
                                >
                                    {{ customer.status ? 'Active' : 'Inactive' }}
                                </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end space-x-2">
                            <Link
                                :href="`/customers/${customer.id}/edit`"
                                class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition"
                                title="Edit"
                            >
                                ✏️ Edit
                            </Link>

                            <button
                                @click="deleteCustomer(customer.id)"
                                class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md transition"
                                title="Delete"
                            >
                                🗑 Delete
                            </button>

                            <button
                                @click="toggleStatus(customer.id)"
                                class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md transition"
                                title="Toggle Status"
                            >
                                🔄 Toggle Status
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
