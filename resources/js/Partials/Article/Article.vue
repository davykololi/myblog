<template>         
        <div class="mb-6" v-memo>
          <div><h2 class="frontend-title">{{ $props.article.title }}</h2></div>
            
            <div><img :src="$props.article.image_url" :alt="$props.article.title" class="w-full h-auto md:h-[421px] object-cover" loading="lazy"/></div>
            <div class="font-hairline mb-2 prose-none">Image: {{ $props.article.caption }}</div>

            <div class="grid grid-cols-1 md:grid-cols-2 mb-6">
              <div>
                <span class="font-bold">Published:</span> {{ $props.article.created_date }} By <Link :href="$props.article.user.absolute_url">{{ $props.article.user.name }}</Link>
              </div>
              <div>
                <span class="font-bold">Read:</span> {{ $props.article.reading_time }}
              </div>
            </div>

            <div v-html="$props.article.content" class="prose prose-blockquote:bg-white prose-blockquote:border-red-700 prose-blockquote:dark:border-stone-800  prose-blockquote:dark:bg-gray-300 prose-blockquote:dark:text-gray-700 dark:text-slate-400 dark:prose-invert prose-li:text-red-700 leading-normal"></div>

            <div><SocialShare :share="$props.shareComponent"/></div>

            <div v-if="!authUser && canLogin">
              <h4 class="font-bold underline">Leave Your Comment:</h4>
              <p>
                Please <span><Link :href="route('login')" class="font-bold animate-pulse text-red-700">Login</Link></span> to comment. We value your feedback.
              </p>
            </div>

            <div v-if="authUser" class="mt-4">
              <CommentForm :article="$props.article"/>
            </div>

            <div><Comments :comments="$props.comments"/></div>
            <div class="items-center"><hr class="w-full mt-4" border-t border-blue-500 border-2xl/></div>
        </div>

      <div v-if="$props.categoryArticles.length != 0">
        <h2 class="text-center font-extrabold uppercase text-3xl">Related Articles</h2>
        <ArticleListWrapper>
        <ArticleList :articles="$props.categoryArticles"/>
      </ArticleListWrapper>
      </div>

      <div v-else-if="$props.featuredArticles.length != 0">
        <h2 class="text-center font-extrabold uppercase text-3xl">Featured Articles</h2>
        <ArticleListWrapper>
        <ArticleList :articles="$props.featuredArticles"/>
      </ArticleListWrapper>
      </div>

      <div v-else></div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed,  defineAsyncComponent, onMounted } from 'vue';
const ArticleList = defineAsyncComponent(() => import('@/Partials/ArticleList/ArticleList.vue'));
import ArticleListWrapper from '@/Partials/ArticleList/ArticleListWrapper.vue';
const SocialShare = defineAsyncComponent(() => import('@/Partials/SocialButtons/SocialShare.vue'));
const Comments = defineAsyncComponent(() => import('@/Partials/Comments/Comments.vue'));
const CommentForm = defineAsyncComponent(() => import('@/Partials/Comments/CommentForm.vue'));

import { VuetifyViewer } from 'vuetify-pro-tiptap';
import 'vuetify-pro-tiptap/style.css'

const page = usePage();
const canLogin = computed(() => page.props.canLogin);
const authUser = computed(() => page.props.auth.user);

const props = defineProps({
  article: Object,
  categoryArticles: Object,
  featuredArticles: Object,
  comments: Object,
  shareComponent: String,
});


import Prism from 'prismjs';
import 'prismjs/themes/prism.css';
import 'prismjs/components/prism-bash';
import 'prismjs/components/prism-javascript';
import 'prismjs/components/prism-json';
import 'prismjs/components/prism-liquid';
import 'prismjs/components/prism-markdown';
import 'prismjs/components/prism-markup-templating';
import 'prismjs/components/prism-php';
import 'prismjs/components/prism-scss';
import 'prismjs/components/prism-typescript';

</script>