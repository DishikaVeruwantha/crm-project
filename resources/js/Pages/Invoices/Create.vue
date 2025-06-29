<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({ customers: Array });

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
    <Head title="Create Invoice" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold text-gray-800">Create Invoice</h2>
        </template>

        <div class="py-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-8">
                <h1 class="text-xl font-semibold text-gray-800 mb-6">New Invoice Details</h1>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Customer -->
                    <div>
                        <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Customer
                        </label>
                        <select
                            id="customer_id"
                            v-model="form.customer_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="" disabled>Select a customer</option>
                            <option v-for="c in customers" :key="c.id" :value="c.id">
                                {{ c.name }}
                            </option>
                        </select>
                        <div v-if="form.errors.customer_id" class="text-sm text-red-600 mt-1">
                            {{ form.errors.customer_id }}
                        </div>
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input
                            id="title"
                            v-model="form.title"
                            type="text"
                            placeholder="Invoice title"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                        <div v-if="form.errors.title" class="text-sm text-red-600 mt-1">
                            {{ form.errors.title }}
                        </div>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                        <input
                            id="amount"
                            v-model="form.amount"
                            type="number"
                            placeholder="Amount (e.g., 100.00)"
                            step="0.01"
                            min="0"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                        <div v-if="form.errors.amount" class="text-sm text-red-600 mt-1">
                            {{ form.errors.amount }}
                        </div>
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                        <input
                            id="due_date"
                            v-model="form.due_date"
                            type="date"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                        <div v-if="form.errors.due_date" class="text-sm text-red-600 mt-1">
                            {{ form.errors.due_date }}
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select
                            id="status"
                            v-model="form.status"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                        </select>
                        <div v-if="form.errors.status" class="text-sm text-red-600 mt-1">
                            {{ form.errors.status }}
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between items-center">
                        <Link
                            href="/invoices"
                            class="text-gray-600 hover:text-gray-800 font-medium"
                        >
                            ← Go Back
                        </Link>

                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg transition"
                            :disabled="form.processing"
                        >
                            Create Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
