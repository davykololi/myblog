<script setup>
import AuthorAuthenticatedLayout from '@/Layouts/AuthorAuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Author Dashboard" />

    <AuthorAuthenticatedLayout>
        <template #header>
            <h2 class="main-header-two">Author Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
    </AuthorAuthenticatedLayout>
</template>
