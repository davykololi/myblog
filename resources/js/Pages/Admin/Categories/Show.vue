<template>
	<Head>
        <title>{{ title }}</title>
    </Head>

	<AdminAuthenticatedLayout>
		<template #header>
        	<h2 class="main-header-two">
            	{{ title }}
        	</h2>
    	</template>
	</AdminAuthenticatedLayout>
</template>

<script setup>
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
defineProps({
	title: String,
});
</script>