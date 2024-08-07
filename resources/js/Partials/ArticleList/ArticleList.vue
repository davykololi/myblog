<template> 
          <div v-if="$props.articles.length != 0" v-for="article in $props.articles" :key="article.id" class="py-4 px-2 md:w-1/2">
            <div class="h-full py-1 rounded-xl shadow-cla-violate text-white overflow-hidden bg-black dark:bg-stone-700 dark:text-slate-400">
                  <img :src="article.image_url" :alt="article.title" class="lg:h-48 md:h-36 w-full object-cover object-center scale-110 transition-all duration-400 hover:scale-100"/>
                  <div class="p-6">
                    <h2 class="tracking-widest text-xs title-font font-medium mb-1">{{ article.category.name }}</h2>
                    <h1 class="title-font text-lg font-medium mb-3">{{ article.title }}</h1>
                    <p class="leading-relaxed mb-3" v-html="article.excerpt"></p>
                    <div class="flex flex-wrap flex-col">
                      <Link :href="article.absolute_url">
                        <PrimaryButtonTwo class="bg-red-700 text-white hover:bg-red-500 hover:text-slate-200 focus:bg-red-400 focus:text-purple-800">
                          Learn more
                        </PrimaryButtonTwo>
                    </Link>
                  </div>
                </div>
            </div>
          </div>

          <div v-else>
            <p class="text-red-700 text-bold">Articles Notyet Puplished</p>
          </div>
</template>
<script setup>
import { Link} from "@inertiajs/vue3";
import PrimaryButtonTwo from '@/Partials/CustomButtons/PrimaryButtonTwo.vue';

const props = defineProps({
        articles: Object,
})
</script>