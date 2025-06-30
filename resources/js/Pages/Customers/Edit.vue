<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

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
    <Head title="Edit Customer" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold text-gray-800">Edit Customer</h2>
        </template>

        <div class="py-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-8">
                <h1 class="text-xl font-semibold text-gray-800 mb-6">Update Customer Details</h1>

                <form @submit.prevent="submit"  novalidate class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="email"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Full name"
                        />
                        <div v-if="form.errors.name" class="text-sm text-red-600 mt-1">
                            {{ form.errors.name }}
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="text"
                            autocomplete="email"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Email address"
                        />
                        <div v-if="form.errors.email" class="text-sm text-red-600 mt-1">
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input
                            id="phone"
                            v-model="form.phone"
                            type="tel"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Phone number"
                        />
                        <div v-if="form.errors.phone" class="text-sm text-red-600 mt-1">
                            {{ form.errors.phone }}
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between items-center">
                        <Link
                            href="/customers"
                            class="text-gray-600 hover:text-gray-800 font-medium"
                        >
                            ← Go Back
                        </Link>
                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg transition"
                            :disabled="form.processing"
                        >
                            Update Customer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
