<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({ customer: Object });

const form = useForm({
    name: props.customer.name,
    email: props.customer.email,
    phone: props.customer.phone
});

function submit() {
    form.put(`/customers/${props.customer.id}`);
}
</script>

<template>
    <Head title="Customers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customers</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="text-2xl font-bold mb-4">Edit Customer</h1>
                    <form @submit.prevent="submit">
                        <input v-model="form.name" />
                        <input v-model="form.email" />
                        <input v-model="form.phone" />
                        <button type="submit" class="btn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
