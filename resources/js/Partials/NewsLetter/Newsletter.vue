<template>                        
                <div class="w-full bg-gray-50 dark:bg-gray-500 dark:text-slate-400">    
                    <div class="p-4">
                        <form @submit.prevent="submit" enctype="multipart/form-data">
                          <div class="space-y-12 md:px-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 uppercase">Subscribe to our newsletter</h2>
                                <p class="mt-1 text-sm leading-6">
                                    Ensure You Don't Miss Our Articles By Subscribing.
                                </p>
                                <div class="w-full">
                                    <div class="mt-2">
                                        <input type="email" v-model="form.email" id="name" autocomplete="Title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter Email Address"/>
                                        <div v-if="form.errors.email" class="danger">{{ form.errors.email }}</div>
                                    </div>
                                </div>

                                <div class="mx-4 md:mx-8">
                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="w-full">
                                        {{ form.progress.percentage }}%
                                    </progress>
                                </div>

                                <PrimaryButtonTwo class="my-4 bg-red-700 hover:text-red-700 hover:bg-white dark:hover:bg-stone-800 dark:bg-black">Submit</PrimaryButtonTwo>
                                
                            </div>           
                          </div>
                        </form>
                    </div>
                </div>
</template>

<script setup>
import PrimaryButtonTwo from "@/Partials/CustomButtons/PrimaryButtonTwo.vue";
import Messages from "@/Partials/Messages/Messages.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import {ref, reactive} from 'vue';
import { computed } from 'vue';

const page = usePage();
const authUser = computed(() => page.props.auth.user.name);

const form = useForm({
    email: ""
});

const submit = () => {
  form.post(route('newsletter.store'));
};
</script>