<template>
  <Head>
    <title>{{ title }}</title>
  </Head>
  
  <AuthorAuthenticatedLayout>
  <template #header>
    <h2 class="main-header-two">{{ title }}</h2>
  </template>

          <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-700">
                    <div><Messages/></div>
                      <div class="mb-12">
                            <Link :href="route('author.articles.index')">
                              <SecondaryButtonTwo class="mb-4" style="float:right">BACK</SecondaryButtonTwo>
                            </Link>
                        </div>
                        <form @submit.prevent="submit" enctype="multipart/form-data">
                          <div class="space-y-12 p-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900 uppercase">Article</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Add Article details here
                                </p>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 md:grid-cols-6 lg:grid-cols-6">
                                    <div class="sm:col-span-12 md:col-span-3">
                                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                        <div class="mt-2">
                                            <input type="text" v-model="form.title" id="name" autocomplete="Title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                                            <div v-if="form.errors.title" class="danger">{{ form.errors.title }}</div>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-12 md:col-span-3">
                                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                        <div class="mt-2">
                                            <input type="text" v-model="form.description" id="name" autocomplete="Description" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                                            <div v-if="form.errors.description" class="danger">{{ form.errors.description }}</div>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-12 md:col-span-3">
                                        <label for="caption" class="block text-sm font-medium leading-6 text-gray-900">Caption</label>
                                        <div class="mt-2">
                                            <input type="text" v-model="form.caption" id="name" autocomplete="Caption" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                                            <div v-if="form.errors.caption" class="danger">{{ form.errors.caption }}</div>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-12 md:col-span-3">
                                        <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                                        <div class="mt-2">
                                            <input type="file" @input="form.image = $event.target.files[0]" id="image" autocomplete="event name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                                            <div v-if="form.errors.image" class="danger">{{ form.errors.image }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 md:grid-cols-6 lg:grid-cols-6">
                                    <div class="sm:col-span-12 md:col-span-3">
                                        <label for="keywords" class="block text-sm font-medium leading-6 text-gray-900">Keywords</label>
                                        <div class="mt-2">
                                            <input type="text" v-model="form.keywords" id="name" autocomplete="Keywords" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                                            <div v-if="form.errors.keywords" class="danger">{{ form.errors.keywords }}</div>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-12 md:col-span-3">
                                        <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                                        <div class="mt-2">
                                            <select name="category_id" id="category_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.category_id">
                                              <option v-for="category in categories" :key="category.id" :value="category.id" selected>
                                                {{ category.name }}
                                              </option>
                                            </select>
                                            <div v-if="form.errors.category_id" class="danger">{{ form.errors.category_id }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="sm:col-span-12 md:col-span-3">
                                        <label for="tags" class="block text-sm font-medium leading-6 text-gray-900">Tags</label>
                                        <div class="mt-2">
                                            <select v-model="form.tags" name="tags[]" class="form-multiselect block w-full mt-1" multiple>
                                              <option selected="true" v-for="tag in tags" :value="tag.id">
                                                <span v-if="tag.id === 1">{{ tag.name }}</span>
                                              </option>
                                              <option v-for="tag in tags" :value="tag.id">
                                                <span v-if="tag.id > 1">{{ tag.name }}</span>
                                              </option>
                                            </select>
                                            <div v-if="form.errors.tags" class="danger">{{ form.errors.tags }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <Editor v-model="form.content"/>
                                    <div v-if="form.errors.content" class="danger">{{ form.errors.content }}</div>
                                </div>

                                    <div class="mx-4 md:mx-8">
                                      <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="w-full">
                                        {{ form.progress.percentage }}%
                                      </progress>
                                    </div>

                                    <PrimaryButtonTwo class="my-4">Submit</PrimaryButtonTwo>
                                
                            </div>           
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  </AuthorAuthenticatedLayout>
</template>

<script setup>
import Multiselect from '@vueform/multiselect';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PrimaryButtonTwo from "@/Partials/CustomButtons/PrimaryButtonTwo.vue";
import SecondaryButtonTwo from "@/Partials/CustomButtons/SecondaryButtonTwo.vue";
import SubmitButton from "@/Partials/CustomButtons/SubmitButton.vue";
import AuthorAuthenticatedLayout from '@/Layouts/AuthorAuthenticatedLayout.vue';
import Messages from "@/Partials/Messages/Messages.vue";
import Editor from '@/Partials/Tiptap/Editor.vue';
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import {ref, reactive} from 'vue';
import { computed } from 'vue';

const page = usePage();
const authUser = computed(() => page.props.auth.user.name);

const props = defineProps({
  title: String,
  categories: Object,
  tags: Object,
});

const form = useForm({
    title: "",
    description: "",
    caption: "",
    image: "",
    content: "",
    keywords: "",
    category_id: "",
    tags: [],
});

const submit = () => {
  form.post(route('author.articles.store'));
};

</script>

<style src="@vueform/multiselect/themes/default.css"></style>
<style lang="scss" scoped></style>
