<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    routelink: {type : Array, default : []},
    text: {type : Array, default : []},
})
</script>
<template>
<div class=" text-white">
    <ul class="flex items-center">
        <li class="flex items-center fill-current text-white">
            <Link :class="'antialiased italic text-white dark:text-slate-400'" :href="route('home')">Home</Link>
            <span class="px-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                </svg>
            </span>
        </li>
        <li class="flex items-center fill-current text-white" v-for="(link, index) in routelink">
            <Link :class="'text-white dark:text-slate-400 antialiased italic'" v-if="index+1 < routelink.length" :href="route(link)">
                {{ text[index] }}
            </Link>
            <span v-else class="text-white dark:text-slate-400">{{ text[index] }}</span>
            <span class="px-3" v-if="index+1 < routelink.length">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                </svg>
            </span>
        </li>
        </ul>
    </div>
</template>
