<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestNav from '@/Partials/Navbars/GuestNav.vue';
import GuestFooter from '@/Partials/Footers/GuestFooter.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen max-w-screen">
        <guest-nav/>

        <!-- Page Heading -->
        <header class="font-bold bg-[#900000] shadow-md dark:bg-gray-800 top-[48px] sticky z-50" v-if="$slots.header">
            <div class="max-w-7xl py-4 px-4 sm:px-6 md:px-8 lg:px-8">
                <slot name="header"/>
            </div>
        </header>

        <div class="bg-gray-400 dark:bg-slate-900 dark:text-slate-400 bg-no-repeat md:bg-fixed lg:bg-fixed bg-cover">
            <div class="max-w-screen h-fit">
                <div class="w-full">
                    <div class="mx-2 md:mx-32 lg:mx-32">
                        <div class="flex flex-col md:flex-row lg:flex-row gap-2">
                            <slot/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <guest-footer/>
    </div>
</template>
