<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    customers: Array,
    proposal: Object
});

const form = useForm({
    customer_id: props.proposal.customer_id,
    title: props.proposal.title,
    amount: props.proposal.amount,
    status: props.proposal.status
});

function submit() {
    form.put(`/proposals/${props.proposal.id}`);
}
</script>

<template>
    <Head title="Edit Proposal" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold text-gray-800">Edit Proposal</h2>
        </template>

        <div class="py-10">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-2xl p-8">
                    <h1 class="text-xl font-semibold text-gray-800 mb-6">Update Proposal Details</h1>

                    <form @submit.prevent="submit" novalidate class="space-y-6">
                        <!-- Customer -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                            <select
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input
                                v-model="form.title"
                                type="text"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Proposal title"
                            />
                            <div v-if="form.errors.title" class="text-sm text-red-600 mt-1">
                                {{ form.errors.title }}
                            </div>
                        </div>

                        <!-- Amount -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                            <input
                                v-model="form.amount"
                                type="number"
                                step="0.01"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter amount"
                            />
                            <div v-if="form.errors.amount" class="text-sm text-red-600 mt-1">
                                {{ form.errors.amount }}
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select
                                v-model="form.status"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                <option value="draft">Draft</option>
                                <option value="approved">Approved</option>
                            </select>
                            <div v-if="form.errors.status" class="text-sm text-red-600 mt-1">
                                {{ form.errors.status }}
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-between items-center">
                            <Link
                                href="/proposals"
                                class="text-gray-600 hover:text-gray-800 font-medium"
                            >
                                ← Cancel
                            </Link>
                            <button
                                type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg transition"
                                :disabled="form.processing"
                            >
                                Update Proposal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
