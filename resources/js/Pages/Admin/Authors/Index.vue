<template>
    <Head>
        <title>{{ title }}</title>
    </Head>	

    <AdminAuthenticatedLayout @load="check">
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
                            <Link :href="route('admin.authors.create')">
                              <PrimaryButton style="float:right">CREATE</PrimaryButton>
                            </Link>
                        </div>
                        <div class="w-full overflow-x-auto shadow-md sm:rounded-lg">
                            <DataTable :data="authors" :columns="columns" :options="{select: true}" class="display bg-slate-900 text-white dark:text-slate-400 dark:bg-slate-900" ref="table" width="100%">
                                <thead class="text-xs text-white uppercase bg-gray-500 dark:bg-black dark:text-slate-400" ref="thead">
                                    <tr>
                                        <th scope="col" class="px-6 py-3" width="35%">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3" width="30%">
                                            Email
                                        </th>
                                    </tr>
                                </thead>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </AdminAuthenticatedLayout>
</template>

<script setup>
import { defineProps, ref, onMounted } from 'vue';
import Messages from "@/Partials/Messages/Messages.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import ShowButton from '@/Partials/CustomButtons/ShowButton.vue';
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";
const page = usePage();
import { computed } from 'vue';
const authUser = computed(() => page.props.auth.user.assigned_role.value);
const admin = computed(() => page.props.auth.user.assigned_role.value === 'admin');


function check(){
    if(!admin){
        return replace('http://localhost:8000');
    }
}

const props = defineProps({
    title: String,
    authors: {
        type: Array,
        default: () => ({}),
    },
    message : String
});

const columns = [
    { data: 'name' },
    { data: 'email' }
];

const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route("admin.authors.destroy", { id: id }),{
                preserveScroll: true,
            }
        );
    }
};

</script>

<style>

</style>
