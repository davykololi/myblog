<template>
        <a type="button" onclick="toggleMode()">
            <SunSvg class="-mb-1 p-2 ml-3 w-8 h-8 text-gray-700 bg-white bg-brightness-125 rounded-md transition cursor-pointer hover:bg-gray-200 block border dark:hidden"/>
            <MoonSvg class="-mb-1 p-2 ml-3 w-8 h-8 text-gray-100 dark:bg-gray-700 rounded-md transition cursor-pointer dark:hover:bg-gray-500 hidden border dark:block"/>
        </a>
</template>
<script setup>
import SunSvg from '@/Components/Assets/SunSvg.vue';
import MoonSvg from '@/Components/Assets/MoonSvg.vue';
</script>