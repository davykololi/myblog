<template>
	<Head>   
    <title v-memo>{{ title }}</title>
    <meta v-memo name="description" :content="description">
    <meta v-memo name="keywords" :content="keywords">
    <link v-memo rel="canonical" :href="canonUrl">
    <meta v-memo property="og:title" :content="title + ' ' + '-' + ' ' + appName">
    <meta v-memo property="og:description" :content="description">
    <meta v-once property="og:type" :content="siteType">
    <meta v-memo property="og:url" :content="siteUrl">
    <meta v-memo property="og:secure_url" :content="siteSecureUrl">
    <meta v-once property="og:site_name" :content="appName">
    <meta v-memo property="article:published_time" :content="publishedDate">
    <meta v-memo property="article:modified_time" :content="modifiedDate">
    <meta v-memo property="og:image" :content="imageUrl">
    <meta v-memo property="og:image:alt" :content="title">
    <meta v-memo property="og:image:secure_url" :content="imageUrl">
    <meta v-once property="og:image:height" :content="imageHeight">
    <meta v-once property="og:image:width" :content="imageWidth">
    <meta v-once name="twitter:card" :content="twitterCard">
    <meta v-memo name="twitter:site" :content="author">
    <meta v-memo name="twitter:creator" :content="author">
    <meta v-memo name="twitter:title" :content="title + ' ' + '-' + ' ' + appName">
    <meta v-memo name="twitter:description" :content="description">
    <meta v-memo name="twitter:url" :content="siteUrl">
  </Head>

	<GuestLayout>
    <template #header>
    	<Breadcrumb :routelink="['blog','article.details' + article.slug,]" :text="['Blog',article.title,]"></Breadcrumb>
    </template>

    <SchemaOrg :schemaorg="blogDetailsSchema" v-memo/>

  	<MainPage>
        <div class="mb-12" v-memo>
            <div>
              <h2 class="frontend-title">{{ article.title }}</h2>
              <hr class=w-full/>
            </div>
            <div>
                Published: {{ article.created_date }} By <Link :href="article.user.absolute_url">{{ article.user.name }}</Link>
            </div>
            <div>Read: {{ article.reading_time }}</div>
            <div><img :src="article.image_url" :alt="article.title" class="w-full h-auto object-cover"/></div>
            <div class="font-bold">Image: {{ article.caption }}</div>
            <div v-html="article.content" class="mt-4"></div>

            <div><social-share :share="shareComponent"/></div>

            <div v-if="!authUser && canLogin">
              <h4 class="font-bold underline">Comment:</h4>
              <p>
                Please <span><Link :href="route('login')" class="font-bold animate-pulse text-red-700">Login</Link></span> to comment. We value your feedback.
              </p>
            </div>

            <div v-if="authUser" class="mt-4">
              <CommentForm :article="article"/>
            </div>

            <div><Comments :comments="$props.comments"/></div>
            <div><hr class="w-full mt-4"/></div>
        </div>

      <div v-if="$props.articles.length != 0" class="mt-2">
        <h2 class="text-center font-extrabold uppercase text-3xl">Related Articles</h2>
      </div>
        
      <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto">
          <div class="flex flex-wrap -m-4">
              <ArticleList :articles="$props.articles"/>
          </div>
        </div>
      </section>
    </MainPage>
    <FrontendSidebar/>
  	</GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import FrontendSidebar from '@/Partials/Sidebars/FrontendSidebar.vue';
import MainPage from '@/Partials/MainPage/MainPage.vue';
import Breadcrumb from '@/Partials/Breadcrumbs/Breadcrumb.vue';
import ArticleList from '@/Partials/ArticleList/ArticleList.vue';
import SocialShare from '@/Partials/SocialButtons/SocialShare.vue';
import Comments from '@/Partials/Comments/Comments.vue';
import CommentForm from '@/Partials/Comments/CommentForm.vue';
const canLogin = computed(() => page.props.canLogin);
import SchemaOrg from '@/Partials/SchemaOrg/SchemaOrg.vue';
import { Head, Link, usePage } from "@inertiajs/vue3";
const page = usePage();
import { computed } from 'vue';
const appName = computed(() => page.props.appName);
const authUser = computed(() => page.props.auth.user);

const props = defineProps({
    article: Object,
    articles: Object,
    comments: Object,
  	sameAs: String,
  	site_type: String,
  	site_name: String,
  	twitter_card: String,
  	site_creator: String,
    imageHeight: String,
    imageWidth: String,
    shareComponent: String,
    artSchemaOrg: Object,
});

const title = computed(() => props.article.title);
const description = computed(() => props.article.description);
const keywords = computed(() => props.article.keywords);
const canonUrl = computed(() => props.article.absolute_url);
const siteType = computed(() => props.site_type);
const siteUrl = computed(() => props.article.absolute_url);
const siteSecureUrl = computed(() => props.article.absolute_url);
const publishedDate = computed(() => props.article.created_at);
const modifiedDate = computed(() => props.article.updated_at);
const author = computed(() => props.article.user.name);
const twitterCard = computed(() => props.twitter_card);
const imageUrl = computed(() => props.article.image_url);
const imageHeight = computed(() => props.imageHeight);
const imageWidth = computed(() => props.imageWidth);
const blogDetailsSchema = computed(() => props.artSchemaOrg);

function padToTwoDigits(number){
  return number.toString().padStart(2,'0');
}

function formatDate(timestamp){
  const date = new Date(timestamp);
  const year = date.getFullYear();
  const month = padToTwoDigits(date.getMonth() + 1);
  const day = padToTwoDigits(date.getDay());
  const hours = padToTwoDigits(date.getHours());
  const minutes = padToTwoDigits(date.getMinutes());
  const seconds = padToTwoDigits(date.getSeconds());

  return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

</script>

