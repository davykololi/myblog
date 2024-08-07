<script setup>
import EditorAuthenticatedLayout from '@/Layouts/EditorAuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Editor Dashboard" />

    <EditorAuthenticatedLayout>
        <template #header>
            <h2 class="main-header-two">Editor Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
    </EditorAuthenticatedLayout>
</template>
