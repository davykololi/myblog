<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
const page = usePage();
const AuthEditor = computed(() => page.props.auth.user.assigned_role === 'editor');
import EditorNav from '@/Partials/Navbars/EditorNav.vue';
import EditorFooter from '@/Partials/Footers/EditorFooter.vue';
</script>

<template>
    <div v-if="AuthEditor">
        <div class="min-h-screen bg-gray-100">
            <editor-nav/>

            <!-- Page Heading -->
            <header class="bg-white shadow-md dark:bg-stone-600 dark:text-slate-400" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="bg-gray-300 dark:bg-slate-900 dark:text-slate-400">
                <div class="max-w-screen h-fit md:min-h-screen lg:min-h-screen">
                    <div class="w-full">
                        <div class="mx-2 md:mx-4 lg:mx-8">
                            <slot/>
                        </div>
                    </div>
                </div>
            </main>
            
            <editor-footer/>
        </div>
    </div>
</template>
