<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
const page = usePage();
const AuthAdmin = computed(() => page.props.auth.user.assigned_role === 'admin');
import AdminNav from '@/Partials/Navbars/AdminNav.vue';
import AdminFooter from '@/Partials/Footers/AdminFooter.vue';
</script>

<template>
    <div v-if="AuthAdmin">
        <div class="min-h-screen bg-gray-100">
            <AdminNav/>

            <!-- Page Heading -->
            <header class="bg-blue-700 text-white shadow dark:bg-stone-600 dark:text-slate-400" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <div class="bg-gray-300 dark:bg-slate-900">
                <div class="max-w-screen h-fit md:min-h-screen lg:min-h-screen">
                    <div class="w-full">
                        <div class="mx-2 md:mx-4 lg:mx-8">
                            <slot/>
                        </div>
                    </div>
                </div>
            </div>

            <AdminFooter/>
        </div>
    </div>
</template>
