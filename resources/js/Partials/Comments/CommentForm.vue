<template>
	<h3 class="font-bold underline mb-2">Leave Your Comment</h3>
	<div>
		<form @submit.prevent="submit">
			<textarea class="w-full rounded-md dark:bg-slate-900 dark:text-slate-400" name="content" v-model="form.content" rows="5" cols="40" placeholder="Comment Here...!"></textarea>
    	<div>
    		<PrimaryButtonTwo class="my-2 bg-red-500 hover:bg-red-800 hover:animate-pulse dark:bg-stone-700 dark:hover:bg-stone-500">
    			Submit
    		</PrimaryButtonTwo>
    	</div>
    </form>
  </div>
</template>

<script setup>
import PrimaryButtonTwo from "@/Partials/CustomButtons/PrimaryButtonTwo.vue";
import { usePage, useForm } from "@inertiajs/vue3";
const page = usePage();
import { computed, ref } from 'vue';
const authUser = computed(() => page.props.auth.user);

const props = defineProps({
	article: Object,
});

const form = useForm({
    content: "",
    user_id: authUser.id,
		article_id: props.article.id,
});

const submit = () => {
  form.post(route('save.comment'),{
  	onSuccess: () => form.reset(),
    preserveScroll: true,
  });
};

</script>
