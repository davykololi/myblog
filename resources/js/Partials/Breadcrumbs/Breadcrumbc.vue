<template>
	<div>
		<ol v-if="crumms.length" class="breadcrumb">
			<li v-for="(crumb, index) in crumbs" class="breadcrun-item" :class="{active: index != crumbs.length - 1}">
				<a v-if="index != crumbs.length - 1" :href="crumb.url">{{crumb.title}}</a>
				<div v-else>{{crumb.title}}</div>
			</li>
		</ol>
	</div>
</template>

<script setup>
const props = defineProps({
	crumbData:{
		type:[Array, Object],
		required: true
	}
});
</script>