<script setup>
import {useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


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
    <Head title="Proposals" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Proposals</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="text-2xl font-bold mb-4">Edit Proposal</h1>
                    <form @submit.prevent="submit">
                        <select v-model="form.customer_id">
                            <option v-for="c in customers" :value="c.id" :key="c.id">{{ c.name }}</option>
                        </select>
                        <input v-model="form.title" placeholder="Title"/>
                        <input v-model="form.amount" type="number" placeholder="Amount"/>
                        <select v-model="form.status">
                            <option value="draft">Draft</option>
                            <option value="approved">Approved</option>
                        </select>
                        <button class="btn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
