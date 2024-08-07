<template>
  <Head>   
    <title v-once>{{ title }}</title>
    <meta v-once name="description" :content="desc">
    <meta v-once name="keywords" :content="keyw">
    <link v-once rel="canonical" :href="canonUrl">
    <meta v-once property="og:title" :content="tle + ' ' + '-' + ' ' + appName">
    <meta v-once property="og:description" :content="desc">
    <meta v-once property="og:type" :content="siteType">
    <meta v-once property="og:url" :content="siteUrl">
    <meta v-once property="og:secure_url" :content="siteSecureUrl">
    <meta v-once property="og:site_name" :content="siteName">

    <meta v-once name="twitter:card" :content="twitterCard">
    <meta v-once name="twitter:site" :content="twitterSite">
    <meta v-once name="twitter:creator" :content="siteCreator">
    <meta v-once name="twitter:title" :content="tle + ' ' + '-' + ' ' + appName">
    <meta v-once name="twitter:description" :content="desc">
    <meta v-once name="twitter:url" :content="siteUrl">
  </Head>

	<GuestLayout>
	   <template #header>
    	 <Breadcrumb :routelink="['blog',]" :text="['Blog',]"></Breadcrumb>
      </template>

      <SchemaOrg :schemaorg="blogSchema" v-memo/>
      
    <MainPage>
      <section class="text-gray-600 body-font">
        <div class="container p-2 mx-auto">
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
import SchemaOrg from '@/Partials/SchemaOrg/SchemaOrg.vue';
import { Head, Link, usePage} from "@inertiajs/vue3";
const page = usePage();
import { computed } from 'vue';
const appName = computed(() => page.props.appName);

const props = defineProps({
  articles: Object,
  title: String,
  description: String,
  keywords: String,
  canonical_url: String,
  site_type: String,
  site_url: String,
  site_secure_url: String,
  site_name: String,
  twitter_card: String,
  site_creator: String,
  bschema: Object,
});

const tle = computed(() => props.title);
const desc = computed(() => props.description);
const keyw = computed(() => props.keywords);
const canonUrl = computed(() => props.canonical_url);
const siteType = computed(() => props.site_type);
const siteUrl = computed(() => props.site_url);
const siteSecureUrl = computed(() => props.site_secure_url);
const siteName = computed(() => props.site_name);
const twitterCard = computed(() => props.twitter_card);
const twitterSite = computed(() => props.site_creator);
const siteCreator = computed(() => props.site_creator);
const blogSchema = computed(() => props.bschema);
</script>
<style lang="scss" scoped></style>