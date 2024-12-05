<template>
    <Head>
        <title>{{ title }}</title>
    </Head>

    <AuthorAuthenticatedLayout>
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
                            <Link :href="route('author.articles.index')">
                              <PrimaryButton style="float:right">BACK</PrimaryButton>
                            </Link>
                        </div>
                        <form @submit.prevent="submit" enctype="multipart/form-data">
                            <div>
                                <InputLabel for="title" value="Title" class="dark:text-slate-400"/>

                                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title"/>

                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>
                            <div>
                                <InputLabel for="description" value="Description" class="dark:text-slate-400"/>

                                <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description"/>

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div>
                                <InputLabel for="caption" value="Caption" class="dark:text-slate-400"/>

                                <TextInput id="caption" type="text" class="mt-1 block w-full" v-model="form.caption"/>

                                <InputError class="mt-2" :message="form.errors.caption" />
                            </div>

                            <div class="mt-4">
                                <Editor v-model="form.content"/>
                                <div v-if="form.errors.content" class="danger">{{ form.errors.content }}</div>
                            </div>

                            <div>
                                <InputLabel for="keywords" value="Keywords" class="dark:text-slate-400"/>

                                <TextInput id="keywords" type="text" class="mt-1 block w-full" v-model="form.keywords"/>

                                <InputError class="mt-2" :message="form.errors.keywords" />
                            </div>
                            
                            <div>
                                <input id="file-upload" name="image" type="file" @change="form.image = $event.target.files[0]" />
                                <div v-if="form.errors.image" class="danger">{{ form.errors.image }}</div>
                            </div>


                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="min-w-max text-sm text-gray-900 bg-transparent border-2 rounded-xl" v-model="form.category_id">
                              <option v-for="category in categories" :key="category.id" :value="category.id" selected>
                                {{ category.name }}
                              </option>
                            </select>
                            <div v-if="form.errors.category_id" class="danger">{{ form.errors.category_id }}</div>

                            <div>
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

                            <div class="mx-4 md:mx-8">
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="w-full">
                                    {{ form.progress.percentage }}%
                                </progress>
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

    </AuthorAuthenticatedLayout>
</template>

<script setup>
import VueDatePicker from "@vuepic/vue-datepicker";
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthorAuthenticatedLayout from '@/Layouts/AuthorAuthenticatedLayout.vue';
import Editor from '@/Partials/Tiptap/Editor.vue';
import { Link, Head, useForm } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';

const props = defineProps({
    title: String,
    article: Object,
    categories: {
        type: Array,
    },

    tags: {
        type: Array,
    },
});

let form = useForm({
    id: props.article.id,
    title: props.article.title,
    description: props.article.description,
    caption: props.article.caption,
    image: props.article.media ? props.article.media[0] : null,
    content: props.article.content,
    keywords: props.article.keywords,
    category_id: "",
    tags: [],
    _method: 'put',
});

const submit = () => {
    const formData = new FormData();
    formData.append('title', form.title);
    formData.append('description', form.description);
    formData.append('caption', form.caption);
    formData.append('content', form.content);
    formData.append('keywords', form.keywords);
    formData.append('tags', form.tags);
    formData.append('category_id', form.category_id);
    
    // Make sure you're appending the actual file object
    if (form.image) {
    formData.append('image', form.image);
    }

    // Use the put method to send the FormData for updating.
    form.post(route('author.articles.update', {id: props.article.id}), {
        body: formData
    });
}

</script>
