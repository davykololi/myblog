<template>
	<div class="mt-4"><h3 class="font-bold underline mb-2">Comments ({{ comments.length }})</h3></div>
	<div v-if="comments.length != 0" v-for="comment in comments" :key="comment.id">
		<div class="bg-white px-4 py-2 dark:bg-black dark:text-white">
			<p><span class="font-bold">{{ comment.user.name }}</span> : {{ comment.created_date }}</p>
			<p class="italic">{{ comment.content }}</p>
			<hr class="w-full"/>
		</div>
	</div>
	<div v-else class="mt-4">
    	<p>No comments at the moment.</p>
    </div>
</template>
<script setup>
const props = defineProps({
	comments: Object,
});
</script>