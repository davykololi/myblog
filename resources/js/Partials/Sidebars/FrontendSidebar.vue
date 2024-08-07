<template>
<div class="sidebar-wrap">
	<div class="p-2 md:p-4 lg:p-4">
		<div class="p-4 pl-4">
			<div>
				<h2 class="sidebar-h2">Categories</h2>
			</div>
			<div v-if="categories.length > 0">
				<p v-for="category in categories" :key="category.id">
					<Link :href="category.absolute_url">{{ category.name }}</Link>
				</p>
			</div>

			<div>
				<h2 class="sidebar-h2">Tags</h2>
			</div>

			<div class="mt-4">
				<Tags :tags="tags"/>
			</div>
		</div>
	</div>
	
</div>
</template>

<script setup>
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";
import Tags from "@/Partials/Tags/Tags.vue";
const page = usePage();
import { computed } from 'vue';
const categories = computed(() => page.props.categories);
const tags = computed(() => page.props.tags);
</script>