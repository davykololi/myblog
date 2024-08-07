<template>
	<Head>
        <title>{{ title }}</title>
    </Head>

	<EditorAuthenticatedLayout>
		<template #header>
        	<h2 class="main-header-two">
            	{{ title }}
        	</h2>
    	</template>

    	<div class="mb-12">
            <Link :href="route('editor.articles.index')">
                <PrimaryButton style="float:right">BACK</PrimaryButton>
            </Link>
        </div>
	</EditorAuthenticatedLayout>
</template>

<script setup>
import EditorAuthenticatedLayout from '@/Layouts/EditorAuthenticatedLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
defineProps({
	title: String,
});
</script>