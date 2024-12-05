<template>
    <nav v-if="breadcrumbs">
        <ul class="flex items-center">
            <li v-for="page in breadcrumbs" class="text-white dark:text-slate-400">
                <div class="flex flex-row">
                    <span v-if="page === '/'" class="text-black dark:text-slate-400">/</span>
                    <span v-else-if="page.url">
                        <Link  :href="page.url" :class="{ 'border-b border-blue-400': page.current }">
                            <span>
                                {{ page.title.replaceAll("-"," ").replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase()) }}
                            </span>
                        </Link>
                    </span>  
                    <span v-else class="dark:text-slate-400">
                        {{ page.title.replaceAll("-"," ").replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase()) }}
                    </span>
                </div>   
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { computed } from 'vue';
const page = usePage();

const props = defineProps({
        breadcrumbview: Object,
});

        // Insert an element between all elements, insertBetween([1, 2, 3], '/') results in [1, '/', 2, '/', 3]
        const insertBetween = (items, insertion) => {
            return items.flatMap(
                (value, index, array) =>
                    array.length - 1 !== index
                        ? [value, insertion]
                        : value,
            )
        }

    const breadcrumbs = computed(() => insertBetween(props.breadcrumbview || [], '/'))
</script>
