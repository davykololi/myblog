<template>
	<teleport to="head">
		<component is="script" type="application/ld+json">
			{{ breadcrumbData }}
		</component>
	</teleport>
</template>

<script setup> 
import { computed } from 'vue';

const props = defineProps({
		jsonldbreadcrumbs: Object,
});
	
const breadcrumbData = computed(() => props.jsonldbreadcrumbs);
</script>