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
                    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-700">
                        <div class="mb-12">
                            <Link :href="route('admin.editors.create')">
                              <PrimaryButton style="float:right">CREATE</PrimaryButton>
                            </Link>
                        </div>
                        <div class="w-full overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left">
                                <thead
                                    class="text-xs text-white uppercase bg-gray-700 dark:bg-black dark:text-slate-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3" width="5%">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3" width="35%">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3" width="30%">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3" width="30%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(editor, index) in editors" :key="index"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ index + 1 }}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ editor.name }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ editor.email }}
                                        </th>

                                        <td class="px-6 py-4 flex flex-row space-x-1">
                                            <Link :href="route('admin.editors.show', editor.id)" class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                                                Details
                                            </Link>
                                            <Link :href="route('admin.editors.edit', editor.id)" class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                                                Edit
                                            </Link>
                                            <PrimaryButton class="bg-red-700" @click="destroy(editor.id)">
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
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import ShowButton from '@/Partials/CustomButtons/ShowButton.vue';
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";
const page = usePage();
import { computed } from 'vue';
const authUser = computed(() => page.props.auth.user.role.value);

const props = defineProps({
    title: String,
    editors: {
        type: Array,
        default: () => ({}),
    },
});

const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route("admin.editors.destroy", id));
    }
}

</script>

<style scoped>
  .right {float:right;}
</style>