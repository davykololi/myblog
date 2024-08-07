<template>
	<Head>
        <title>{{ title }}</title>
    </Head>

	<AuthorAuthenticatedLayout>
		<template #header>
        	<h2 class="main-header-two">
            	{{ title }}
        	</h2>
        	<div class="py-12">
            	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                	<Link
                    	class="py-3 px-5 m-2 rounded bg-blue-600 text-white float-end"
                    	:href="route('author.articles.index')"
                    	>Back</Link
                	>
                	<div class="p-12 px-3 m-auto rounded-lg">
                    	<div class="mt-12 bg-white py-5 px-3 rounded-lg">
                        	<h1 class="text-2xl font-bold">
                            	{{ props.article.title }}
                        	</h1>
                        	<div>
                            	{{ props.article.description }}
                        	</div>
                        	<div class="text-sm">
                            	{{ props.article.created_at }} -
                            	{{ props.article.updated_at }}
                        	</div>
                    	</div>
                	</div>
            	</div>
        	</div>
    	</template>
	</AuthorAuthenticatedLayout>
</template>

<script setup>
import AuthorAuthenticatedLayout from '@/Layouts/AuthorAuthenticatedLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
				title: String,
				article: Object,
			});
</script>