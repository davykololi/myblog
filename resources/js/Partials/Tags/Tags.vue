<template>
	<div v-if="$props.tags.length != 0">
		<div v-for="tag in $props.tags" :key="tag.id" class="flex inline-flex">
			<Link :href="tag.absolute_url">
				<v-btn color="white" class="m-0.5">
					<span class="text-red-700">{{ tag.name }}</span>
				</v-btn>
			</Link>
		</div>
	</div>
</template>

<script setup>
import { Link} from "@inertiajs/vue3";

const props = defineProps({
	tags: Object,
})
</script>