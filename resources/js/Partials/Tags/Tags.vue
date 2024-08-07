<template>
	<div v-if="$props.tags.length != 0">
		<div v-for="tag in $props.tags" :key="tag.id" class="flex inline-flex">
			<Link :href="tag.absolute_url" class="bg-white text-red-700 px-2 rounded-md mt-4 mx-0.5">{{ tag.name }}</Link>
		</div>
	</div>
</template>

<script setup>
import { Link} from "@inertiajs/vue3";

const props = defineProps({
	tags: Object,
})
</script>