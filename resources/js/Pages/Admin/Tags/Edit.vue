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
                    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-700 dark:text-slate-400">
                        <div class="mb-12">
                            <Link :href="route('admin.tags.index')">
                              <PrimaryButton style="float:right">BACK</PrimaryButton>
                            </Link>
                        </div>
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Cateory Name" class="dark:text-slate-400"/>

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"/>

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div>
                                <InputLabel for="description" value="Category Description" class="dark:text-slate-400"/>

                                <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description"/>

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div>
                                <InputLabel for="keywords" value="Category Keywords" class="dark:text-slate-400"/>

                                <TextInput id="keywords" type="text" class="mt-1 block w-full" v-model="form.keywords"/>

                                <InputError class="mt-2" :message="form.errors.keywords" />
                            </div>
                            <div class="mt-4">
                                <PrimaryButton type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>

<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    tag: {
        type: Object,
        default: () => ({}),
    },

    title: String,
});

const form = useForm({
    id: props.tag.id,
    name: props.tag.name,
    description: props.tag.description,
    keywords: props.tag.keywords,
});


const submit = () => {
    form.put(route("admin.tags.update", props.tag.id));
};

</script>
