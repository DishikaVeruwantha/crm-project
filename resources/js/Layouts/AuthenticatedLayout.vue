<script setup>
import { ref } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const showingNavigationDropdown = ref(false);
const page = usePage();
const user = page.props.auth.user;
</script>


<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white border-b shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Left: Logo + Nav -->
                    <div class="flex items-center space-x-8">
                        <Link :href="route('dashboard')" class="flex items-center space-x-2">
                            <ApplicationLogo class="h-8 w-auto text-indigo-600" />
                            <span class="text-xl font-bold text-gray-800 hidden sm:inline">CRM</span>
                        </Link>
                        <div class="hidden md:flex space-x-6">
                            <NavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</NavLink>
                            <NavLink :href="route('customers.index')" :active="route().current('customers.index')">Customers</NavLink>
                            <NavLink :href="route('proposals.index')" :active="route().current('proposals.index')">Proposals</NavLink>
                            <NavLink :href="route('invoices.index')" :active="route().current('invoices.index')">Invoices</NavLink>
                            <NavLink :href="route('transactions.index')" :active="route().current('transactions.index')">Transactions</NavLink>
                        </div>
                    </div>

                    <!-- Right: Profile -->
                    <div class="flex items-center space-x-4">
                        <!-- Desktop Dropdown -->
                        <div class="hidden md:block">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <button class="flex items-center space-x-2 focus:outline-none">
                                        <img
                                            class="h-9 w-9 rounded-full object-cover border border-gray-300"
                                            :src="`https://ui-avatars.com/api/?name=${user.name[0]}&background=4f46e5&color=fff`"
                                            alt="User Avatar"
                                        />
                                        <span class="hidden sm:inline text-sm font-medium text-gray-700">{{ user.name }}</span>
                                    </button>
                                </template>
                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                                </template>
                            </Dropdown>
                        </div>

                        <!-- Hamburger -->
                        <div class="md:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path
                                        :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Nav -->
            <div v-if="showingNavigationDropdown" class="md:hidden px-4 pb-4">
                <div class="space-y-1 mt-2">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('customers.index')" :active="route().current('customers.index')">Customers</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('proposals.index')" :active="route().current('proposals.index')">Proposals</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('invoices.index')" :active="route().current('invoices.index')">Invoices</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('transactions.index')" :active="route().current('transactions.index')">Transactions</ResponsiveNavLink>
                </div>

                <!-- Mobile Profile -->
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="flex items-center space-x-3">
                        <img
                            class="h-9 w-9 rounded-full object-cover border border-gray-300"
                            :src="`https://ui-avatars.com/api/?name=${user.name}&background=4f46e5&color=fff`"
                            alt="User"
                        />
                        <div>
                            <div class="font-medium text-base text-gray-800">{{ user.name }}</div>
                            <div class="text-sm text-gray-500">{{ user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')">Profile</ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">Log Out</ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <header v-if="$slots.header" class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main class="py-6">
            <slot />
        </main>
    </div>
</template>
