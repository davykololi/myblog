<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
const page = usePage();
const AuthAuthor = computed(() => page.props.auth.user.assigned_role === 'author');
import AuthorNav from '@/Partials/Navbars/AuthorNav.vue';
import AuthorFooter from '@/Partials/Footers/AuthorFooter.vue';
</script>

<template>
    <div v-if="AuthAuthor">
        <div class="bg-gray-100">
            <author-nav/>

            <!-- Page Heading -->
            <header class="bg-white shadow-md dark:bg-stone-600" v-if="$slots.header">
                <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 border-b border-black">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="bg-gray-300 text-gray-700 dark:bg-slate-900 dark:text-slate-400">
                <div class="max-w-screen h-fit md:min-h-screen lg:min-h-screen">
                    <div class="w-full">
                        <div class="mx-2 md:mx-4 lg:mx-8">
                            <slot/>
                        </div>
                    </div>
                </div>
            </main>

            <author-footer/>
        </div>
    </div>
</template>
