<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestNav from '@/Partials/Navbars/GuestNav.vue';
import GuestFooter from '@/Partials/Footers/GuestFooter.vue';
import Newsletter from '@/Partials/Newsletter/Newsletter.vue';
import { Link } from '@inertiajs/vue3';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
</script>

<template>
    <div class="min-h-screen min-w-screen">
        <GuestNav/>
        <div class="relative my-1">
            <Splide :options="{ rewind: true }" aria-label="My Favorite Images">
                <SplideSlide>
                    <img src="/static/bannerone.jpg" alt="web banner"/>
                </SplideSlide>
                <SplideSlide>
                    <img src="/static/bannertwo.jpg" alt="web banner"/>
                </SplideSlide>
                <SplideSlide>
                    <img src="/static/bannerthree.jpg" alt="web banner"/>
                </SplideSlide>
            </Splide>
        </div>

        <!-- Page Heading -->
        <header class="font-bold bg-red-800 shadow-md dark:bg-gray-800 top-[48px] sticky z-50" v-if="$slots.header">
            <div class="max-w-7xl py-4 px-4 sm:px-6 md:px-8 lg:px-8">
                <slot name="header"/>
            </div>
        </header>

        <div class="bg-gray-200 dark:bg-gray-700 dark:text-slate-400 bg-no-repeat md:bg-fixed lg:bg-fixed bg-cover pb-4">
            <div class=" mx-auto h-fit w-full">
                <div class="md:px-16 lg:px-16">
                    <div class="flex flex-col md:flex-row lg:flex-row gap-2">
                        <slot/>
                    </div>
                </div>
            </div>
        </div>
        <Newsletter/>
        <GuestFooter/>
    </div>
</template>
