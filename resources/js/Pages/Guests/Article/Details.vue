<template>
	<Head>   
    <title v-memo>{{ title }}</title>
    <meta v-memo name="description" :content="description">
    <meta v-memo name="keywords" :content="keywords">
    <meta v-once name="robots" :content="robots">
    <meta v-once name="googlebot" :content="robots">
    <link v-memo rel="canonical" :href="canonUrl">
    <meta v-memo property="og:title" :content="title + ' ' + '-' + ' ' + appName">
    <meta v-memo property="og:description" :content="description">
    <meta v-once property="og:type" :content="siteType">
    <meta v-memo property="og:url" :content="siteUrl">
    <meta v-memo property="og:secure_url" :content="siteSecureUrl">
    <meta v-once property="og:site_name" :content="appName">
    <meta v-memo property="article:published_time" :content="publishedDate">
    <meta v-memo property="article:modified_time" :content="modifiedDate">
    <meta v-memo property="article:tag" :content="articleTag">
    <meta v-memo property="article:section" :content="articleSection">
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
    	 <BreadcrumbView :breadcrumbview="breadcrumbsJsonld" v-memo/>
    </template>
    <SchemaOrg :schemaorg="blogDetailsSchema" v-memo/>
    <BreadcrumbsJsonld :jsonldbreadcrumbs="headBreadcrumb"/>
  	<MainPage class="px-4 md:px-8">
        <Article :article="$props.article" :key="$props.article.id" :categoryArticles="$props.categoryArticles" :featuredArticles="$props.featuredArticles" :comments="$props.comments" :shareComponent="$props.shareComponent" v-memo/>
    </MainPage>
    <FrontendSidebar/>
  	</GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import FrontendSidebar from '@/Partials/Sidebars/FrontendSidebar.vue';
import MainPage from '@/Partials/MainPage/MainPage.vue';
import Breadcrumb from '@/Partials/Breadcrumbs/Breadcrumb.vue';
import BreadcrumbView from '@/Partials/Breadcrumbs/BreadcrumbView.vue';
import BreadcrumbsJsonld from '@/Partials/Breadcrumbs/BreadcrumbsJsonld.vue';
import Article from '@/Partials/Article/Article.vue';
import Prism from '@/Partials/Prism/Prism.vue';
import SchemaOrg from '@/Partials/SchemaOrg/SchemaOrg.vue';
import { Head, usePage } from "@inertiajs/vue3";
import 'vuetify-pro-tiptap/style.css';
import { computed } from 'vue';

const page = usePage();
const appName = computed(() => page.props.appName);
const breadcrumbsJsonld = computed(() => page.props.breadcrumbs);

const props = defineProps({
    article: Object,
    featuredArticles: Object,
    categoryArticles: Object,
    tagsNamesArray: String,
    comments: Object,
  	sameAs: String,
  	site_type: String,
  	site_name: String,
    canonical_url: String,
    robots: String,
  	twitter_card: String,
  	site_creator: String,
    imageHeight: String,
    imageWidth: String,
    shareComponent: String,
    artSchemaOrg: Object,
    articleJsonLdBreadcrumb: Object,
});

const title = computed(() => props.article.title);
const description = computed(() => props.article.description);
const keywords = computed(() => props.article.keywords);
const canonUrl = computed(() => props.canonical_url);
const robots = computed(() => props.robots);
const siteType = computed(() => props.site_type);
const siteUrl = computed(() => props.article.absolute_url);
const siteSecureUrl = computed(() => props.article.absolute_url);
const publishedDate = computed(() => props.article.created_at);
const modifiedDate = computed(() => props.article.updated_at);
const articleTag = computed(() => props.tagsNamesArray);
const articleSection = computed(() => props.article.category.name);
const author = computed(() => props.article.user.name);
const twitterCard = computed(() => props.twitter_card);
const imageUrl = computed(() => props.article.image_url);
const imageHeight = computed(() => props.imageHeight);
const imageWidth = computed(() => props.imageWidth);
const blogDetailsSchema = computed(() => props.artSchemaOrg);
const headBreadcrumb = computed(() => props.articleJsonLdBreadcrumb);

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