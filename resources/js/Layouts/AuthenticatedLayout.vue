<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
const page = usePage();
const AuthVisitor = computed(() => page.props.auth.user.assigned_role === 'visitor');
import GuestNav from '@/Partials/Navbars/GuestNav.vue';
import GuestFooter from '@/Partials/Footers/GuestFooter.vue';
</script>

<template>
    <div v-if="AuthVisitor">
        <div class="min-h-screen bg-gray-100">
            <GuestNav/>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Dynamic Heading -->
            <header class="bg-white shadow" v-if="$slots.dynamicheader">
                <div class="max-w-7xl py-3 px-4 sm:px-6 lg:px-8 border-b border-black">
                    <slot name="dynamicheader" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="bg-red-300">
                <slot />
            </main>

            <GuestFooter/>
        </div>
    </div>
</template>
