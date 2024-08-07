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
                        <div class="mb-12">
                            <Link :href="route('admin.tags.create')">
                              <PrimaryButton style="float:right">CREATE</PrimaryButton>
                            </Link>
                        </div>
                        <div class="w-full overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-white uppercase bg-gray-700 dark:bg-black dark:text-slate-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Keywords
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(tag, index) in tags" :key="index"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ index + 1 }}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ tag.name }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ tag.description }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ tag.keywords }}
                                        </th>

                                        <td class="px-6 py-4 flex flex-row space-x-1">
                                            <Link :href="route('admin.tags.show', tag.id)">
                                                <SecondaryButtonTwo>Details</SecondaryButtonTwo>
                                            </Link>
                                            <Link :href="route('admin.tags.edit', tag.id)">
                                                <PrimaryButtonTwo>Edit</PrimaryButtonTwo>
                                            </Link>
                                            <PrimaryButton class="bg-red-700" @click="destroy(tag.id)">
                                                Delete
                                            </PrimaryButton>
                                        </td>
                                    </tr>
                                </tbody>
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
import PrimaryButtonTwo from "@/Partials/CustomButtons/PrimaryButtonTwo.vue";
import SecondaryButtonTwo from "@/Partials/CustomButtons/SecondaryButtonTwo.vue";
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import ShowButton from '@/Partials/CustomButtons/ShowButton.vue';
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";
const page = usePage();
import { computed } from 'vue';
const authUser = computed(() => page.props.auth.user.role.value);

const props = defineProps({
    title: String,
    tags: {
        type: Array,
        default: () => ({}),
    },
});

const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route("admin.tags.destroy", id));
    }
}

</script>

<style scoped>
  .right {float:right;}
</style>