<script setup>
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({ proposals: Array });

function deleteProposal(id) {
    if (confirm('Delete this proposal?')) {
        router.delete(`/proposals/${id}`);
    }
}
</script>


<template>
    <Head title="Proposals" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Proposals</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Link href="/proposals/create" class="btn">+ New Proposal</Link>
                    <table class="table-auto w-full mt-4">
                        <thead>
                        <tr>
                            <th>Title</th><th>Customer</th><th>Amount</th><th>Status</th><th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="proposal in proposals" :key="proposal.id">
                            <td>{{ proposal.title }}</td>
                            <td>{{ proposal.customer.name }}</td>
                            <td>{{ proposal.amount }}</td>
                            <td>{{ proposal.status }}</td>
                            <td class="flex items-center space-x-2">
                                <Link :href="`/proposals/${proposal.id}/edit`">
                                    <button class="bg-blue-600 text-white px-3 py-1 rounded">
                                        Edit
                                    </button>
                                </Link>
                                <form @submit.prevent="deleteProposal(proposal.id)">
                                    <button class="bg-red-600 text-white px-3 py-1 rounded mr-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
