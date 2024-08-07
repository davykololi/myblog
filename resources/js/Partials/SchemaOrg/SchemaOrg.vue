<template>
	<teleport to="head">
		<component is="script" type="application/ld+json">
			{{ structuredData }}
		</component>
	</teleport>
</template>

<script setup> 
import { computed } from 'vue';

const props = defineProps({
		schemaorg: Object,
});
	
const structuredData = computed(() => props.schemaorg);
</script>