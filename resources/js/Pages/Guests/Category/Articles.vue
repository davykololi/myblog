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
    <meta v-memo property="og:type" :content="siteType">
    <meta v-memo property="og:url" :content="siteUrl">
    <meta v-memo property="og:secure_url" :content="siteSecureUrl">
    <meta v-once property="og:site_name" :content="appName">
    <meta v-memo name="twitter:site" :content="twitterSite">
    <meta v-memo name="twitter:creator" :content="siteCreator">
    <meta v-memo name="twitter:title" :content="title + ' ' + '-' + ' ' + appName">
    <meta v-memo name="twitter:description" :content="description">
    <meta v-memo name="twitter:url" :content="siteUrl">
  </Head>

	<GuestLayout>
	   <template #header>
    	 <BreadcrumbView :breadcrumbview="breadcrumbsJsonld" v-memo/>
      </template>
      <SchemaOrg :schemaorg="catSchema" v-memo/>
      <BreadcrumbsJsonld :jsonldbreadcrumbs="headBreadcrumb"/>
  	<MainPage>
      <ArticleListWrapper v-if="$props.categoryArticles.length =! 0">
        <h2 class="block-articles">{{ category.name }} Articles</h2>
        <ArticleList :articles="$props.categoryArticles"/>
      </ArticleListWrapper>
      <ArticleListWrapper v-else class="w-full">
        <p class="text-red-700 font-extrabold text-center uppercase">
          {{ category.name }} Articles Notyet Puplished
        </p>
      </ArticleListWrapper>
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
import ArticleList from '@/Partials/ArticleList/ArticleList.vue';
import ArticleListWrapper from '@/Partials/ArticleList/ArticleListWrapper.vue';
import SchemaOrg from '@/Partials/SchemaOrg/SchemaOrg.vue';
import { Head, Link, usePage} from "@inertiajs/vue3";
const page = usePage();
import { computed } from 'vue';
const appName = computed(() => page.props.appName);
const breadcrumbsJsonld = computed(() => page.props.breadcrumbs);

const props = defineProps({
			category: Object,
      categoryArticles: Object,
			site_type: String,
			site_creator: String,
      canonical_url: String,
      robots: String,
      catSchemaOrg: Object,
      categoryJsonLdBreadcrumb: Object,
		});

const title = computed(() => props.category.name + " " + "Articles");
const description = computed(() => props.category.description);
const keywords = computed(() => props.category.keywords);
const canonUrl = computed(() => props.canonical_url);
const robots = computed(() => props.robots);
const siteType = computed(() => props.site_type);
const siteUrl = computed(() => props.category.absolute_url);
const siteSecureUrl = computed(() => props.category.absolute_url);
const twitterSite = computed(() => props.site_creator);
const siteCreator = computed(() => props.site_creator);
const catSchema = computed(() => props.catSchemaOrg);
const headBreadcrumb = computed(() => props.categoryJsonLdBreadcrumb);
</script>