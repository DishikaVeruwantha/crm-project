<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    stats: Object
});

function formatLabel(key) {
    return key
        .replace(/_/g, ' ')
        .replace(/\b\w/g, char => char.toUpperCase());
}

function formatValue(key, value) {
    if (key === 'revenue_this_month') {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        }).format(value);
    }
    return value;
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-900">CRM Dashboard</h2>
        </template>

        <div class="py-10 px-4 sm:px-6 lg:px-8">
            <!-- Greeting -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Welcome back!</h3>
                <p class="text-sm text-gray-600">Here's what's happening in your CRM today.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div
                    v-for="(value, key) in props.stats"
                    :key="key"
                    class="bg-white p-6 rounded-2xl shadow hover:shadow-md transition"
                >
                    <p class="text-sm text-gray-500">{{ formatLabel(key) }}</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ formatValue(key, value) }}</p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <a
                        href="/customers"
                        class="bg-indigo-100 hover:bg-indigo-200 text-indigo-700 font-medium p-4 rounded-lg text-center"
                    >
                        Manage Customers
                    </a>
                    <a
                        href="/proposals"
                        class="bg-green-100 hover:bg-green-200 text-green-700 font-medium p-4 rounded-lg text-center"
                    >
                        View Proposals
                    </a>
                    <a
                        href="/invoices"
                        class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 font-medium p-4 rounded-lg text-center"
                    >
                        View Invoices
                    </a>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
