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
                    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-700 dark:text-slate-700">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Editors Name" class="dark:text-slate-400"/>

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"/>

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div>
                                <InputLabel for="email" value="Email Address" class="dark:text-slate-400"/>

                                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"/>

                                <InputError class="mt-2" :message="form.errors.email" />
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
    editor: {
        type: Object,
        default: () => ({}),
    },

    title: String,
});

const form = useForm({
    id: props.editor.id,
    name: props.editor.name,
    email: props.editor.email,
});


const submit = () => {
    form.put(route("admin.editors.update", props.editor.id));
};

</script>
