<template>
    <nav v-if="breadcrumbs">
        <ol>
            <li v-for="page in breadcrumbs">
                <div>
                    <span v-if="page === '/'">/</span>
                    <a
                        v-else-if="page.url"
                        :href="page.url"
                        :class="{ 'border-b border-blue-400': page.current }"
                    >{{ page.title }}</a>
                    <span v-else>{{ page.title }}</span>
                </div>
            </li>
        </ol>
    </nav>
</template>

<script>
import { usePage } from "@inertiajs/vue3";
import { computed } from 'vue';

        // Insert an element between all elements, insertBetween([1, 2, 3], '/') results in [1, '/', 2, '/', 3]
        const insertBetween = (items, insertion) => {
            return items.flatMap(
                (value, index, array) =>
                    array.length - 1 !== index
                        ? [value, insertion]
                        : value,
            )
        }

    const breadcrumbs = computed(() => insertBetween(usePage().props.value.breadcrumbs || [], '/'))
</script>
