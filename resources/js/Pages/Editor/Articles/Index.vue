<template>
    <Head>
        <title>{{ title }}</title>
    </Head>

  <EditorAuthenticatedLayout>
  <template #header>
    <h2 class="main-header-two">{{ title }}</h2>
  </template>

  <div class="w-full">

  <div>
    <Messages/>
  </div>

  <div class="overflow-x-auto">
  <table class="table-auto  text-left text-sm font-light bg-transparent">
    <thead class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:text-slate-400 dark:bg-black">
      <tr class="bg-gray-800 text-white hover:text-slate-400 dark:text-slate-400 px-4 md:px-8">
        <th scope="col" class="px-2 py-4" width="5%">No</th>
        <th scope="col" class="px-2 py-4" width="25%">Title</th>
        <th scope="col" class="px-2 py-4" width="15%">Image</th>
        <th scope="col" class="px-2 py-4" width="40%">Content</th>
        <th scope="col" class="px-2 py-4" width="15%">Action</th>
      </tr>
    </thead>
    <tbody v-if="props.articles.data.length > 0">
      <tr v-for="article in $props.articles.data" :key="article.id" class="bg-white border-b dark:border-neutral-500 dark:text-slate-400 dark:bg-slate-800 px-4 md:px-8">
        <td class="px-2">{{ index + 1 }}</td>
        <td class="px-2">{{ article.title }}</td>
        <td class="px-2"><img :src="article.image_url" :alt="article.title" style="width:60%"/></td>
        <td class="px-2"><div v-html="article.excerpt"></div></td>
        <td class="flex flex-row space-x-1 px-2">
        <Link :href="route('editor.articles.show', article.id)">
          <SecondaryButtonTwo>Details</SecondaryButtonTwo>
        </Link>
        <Link :href="route('editor.articles.edit', article.id)">
          <PrimaryButtonTwo>Edit</PrimaryButtonTwo>
        </Link>
        <PrimaryButton class="bg-red-700" @click="destroy(article.id)">
          Delete
        </PrimaryButton>
        </td>
      </tr>
    </tbody>
    <tfoot v-else>
      <tr class="text-center text-white bg-red-700 uppercase tracking-tighter h-12 dark:bg-gray-700 dark:text-slate-400">
        <td colspan="12"> 
          {{ authUser }} has no artcles at the moment 
        </td>
      </tr>
    </tfoot>
  </table>
  <Pagination :data="props.articles" class="mt-4"/>
  </div>
  </div>

  </EditorAuthenticatedLayout>
</template>

<script setup>
import EditorAuthenticatedLayout from '@/Layouts/EditorAuthenticatedLayout.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PrimaryButtonTwo from "@/Partials/CustomButtons/PrimaryButtonTwo.vue";
import SecondaryButtonTwo from "@/Partials/CustomButtons/SecondaryButtonTwo.vue";
import Messages from "@/Partials/Messages/Messages.vue";
import Pagination from "@/Partials/Pagination/Pagination.vue";
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";
const page = usePage();
import { computed } from 'vue';
const authUser = computed(() => page.props.auth.user.name);

const props = defineProps({
  articles: Object,
  title: String
});

const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route("editor.articles.destroy", { id: id }),{
                preserveScroll: true,
            }
        );
    }
};

</script>
