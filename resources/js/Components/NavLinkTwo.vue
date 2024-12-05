<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[red] dark:border-slate-400 text-sm font-medium leading-5 text-red-700 focus:outline-none focus:border-[yellow] transition duration-150 ease-in-out dark:text-slate-200'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-red-600 hover:text-red-400 hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-100 transition duration-150 ease-in-out dark:text-slate-400 hover:brightness-125'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
