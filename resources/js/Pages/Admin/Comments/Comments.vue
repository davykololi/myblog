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

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="dark:bg-gray-700"><Messages/></div>
                    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-700 dark:text-slate-400">
                        <div class="w-full overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-white uppercase bg-gray-700 dark:bg-black dark:text-slate-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Comment
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Article Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Commented At
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody v-if="comments.length != 0">
                                    <tr v-for="(comment, index) in comments" :key="index"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ index + 1 }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ comment.content }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ comment.article.title }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ comment.created_date }}
                                        </th>
                                        <td class="px-6 py-4 flex flex-row space-x-1">
                                            <PrimaryButton class="bg-red-700" @click="destroy(comment.id)">
                                                Delete
                                            </PrimaryButton>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot v-else>
                                    <tr>
                                        <td>
                                            <div class="text-red-700 font-bold text-2xl mx-4">No Comments blog users at the moment.</div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </AdminAuthenticatedLayout>
</template>

<script setup>
import Messages from "@/Partials/Messages/Messages.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    title: String,
    comments: {
        type: Array,
        default: () => ({}),
    },
});

const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.get(route("admin.comments.delete", id,{
            preserveScroll: true,
        }));
    }
}

</script>

<style scoped>
  .right {float:right;}
</style>