<script setup>
import { router, Link, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
defineProps({ proposals: Array });

function deleteProposal(id) {
    if (confirm('Are you sure you want to delete this proposal?')) {
        router.delete(`/proposals/${id}`);
    }
}
</script>

<template>
    <Head title="Proposals" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold text-gray-800">Proposals</h2>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-2xl p-6">
                    <!-- Header Actions -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">All Proposals</h3>
                        <Link
                            href="/proposals/create"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition"
                        >
                            + New Proposal
                        </Link>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                            <tr
                                v-for="proposal in proposals"
                                :key="proposal.id"
                                class="hover:bg-gray-50 transition"
                            >
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                    {{ proposal.title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ proposal.customer.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    ${{ Number(proposal.amount).toFixed(2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            :class="{
                                                'text-green-600 font-medium': proposal.status === 'approved',
                                                'text-yellow-600 font-medium': proposal.status === 'pending',
                                                'text-red-600 font-medium': proposal.status === 'rejected'
                                            }"
                                        >
                                            {{ proposal.status }}
                                        </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right space-x-2">
                                    <Link
                                        :href="`/proposals/${proposal.id}/edit`"
                                        class="inline-block bg-blue-500 text-white px-3 py-1.5 rounded hover:bg-blue-600 transition"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="deleteProposal(proposal.id)"
                                        class="inline-block bg-red-500 text-white px-3 py-1.5 rounded hover:bg-red-600 transition"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <tr v-if="proposals.length === 0">
                                <td colspan="5" class="text-center text-gray-500 py-6">
                                    No proposals found.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
