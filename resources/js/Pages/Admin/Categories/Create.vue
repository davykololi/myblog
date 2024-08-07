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
                            <Link :href="route('admin.categories.index')">
                              <PrimaryButton style="float:right">BACK</PrimaryButton>
                            </Link>
                        </div>
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Category Name" class="dark:text-slate-400"/>

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    placeholder="Name"
                                    autocomplete="name"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>

                            <div>
                                <InputLabel for="description" value="Category Description" class="dark:text-slate-400"/>

                                <TextInput
                                    id="description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.description"
                                    placeholder="Description"
                                    autocomplete="description"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.description"
                                />
                            </div>

                            <div>
                                <InputLabel for="keywords" value="Category Keywords" class="dark:text-slate-400"/>

                                <TextInput
                                    id="keywords"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.keywords"
                                    placeholder="Keywords"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.keywords"
                                />
                            </div>

                            <div class="mt-4">
                              <PrimaryButton type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Add
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
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
  title: String,
  errors: Object,
});

const form = useForm({
  name: "",
  description: "",
  keywords: "",
});

const submit = () => {
  form.post('/admin/categories',{

    preserveScroll: true,

    onError: () => {
        return "Hi! , the server returned an error and Inertia saved it as a prop. Do as you like with me"
    },
    onSuccess: () => {
      return "Wohoo!!"
    }
  });
}

</script>