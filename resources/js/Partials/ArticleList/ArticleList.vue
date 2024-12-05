<template> 
          <div v-if="$props.articles.length != 0" v-for="article in $props.articles" :key="article.id" class="py-4 px-2 md:w-1/2">
            <article class="h-full py-1 rounded shadow-cla-violate text-white overflow-hidden bg-gray-300 dark:bg-stone-700">
              <Link :href="article.absolute_url">
                <img :src="article.image_url" :alt="article.title" class="lg:h-48 md:h-36 w-full object-cover object-center scale-110 transition-all duration-400 hover:scale-100" loading="lazy"/>
              </Link>
                <div class="p-6 h-[100%] bg-red-800 dark:bg-stone-800 dark:text-slate-400 prose dark:prose-invert">
                <div>
                  <Link :href="article.absolute_url">
                    <h1 class="title-font text-white text-lg font-medium mb-3">{{ article.title }}</h1>
                  </Link>
                  <p class="leading-relaxed mb-3 text-white" v-html="article.excerpt"></p>
                </div>
                  <div class="flex flex-wrap flex-col">
                    <Link :href="article.absolute_url">
                      <v-btn color="white"><span class="text-red-700 dark:text-slate-400">Learn more</span></v-btn>
                    </Link>
                  </div>
                </div>
            </article>
          </div>
</template>
<script setup>
import { Link} from "@inertiajs/vue3";
import PrimaryButtonTwo from '@/Partials/CustomButtons/PrimaryButtonTwo.vue';

const props = defineProps({
        articles: Object,
})
</script>