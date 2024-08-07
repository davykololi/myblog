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
    	<Breadcrumb :routelink="['private-policy',]" :text="['Private Policy Statement',]"></Breadcrumb>
  	</template>

    <SchemaOrg :schemaorg="policySchema" v-memo/>

		<MainPage>
        <h2 v-once class="uppercase">{{ title }}</h2>
    </MainPage>
    <FrontendSidebar/>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import FrontendSidebar from '@/Partials/Sidebars/FrontendSidebar.vue';
import MainPage from '@/Partials/MainPage/MainPage.vue';
import Breadcrumb from '@/Partials/Breadcrumbs/Breadcrumb.vue';
import SchemaOrg from '@/Partials/SchemaOrg/SchemaOrg.vue';
import { Head, usePage } from "@inertiajs/vue3";
const page = usePage();
import { computed } from 'vue';
const appName = computed(() => page.props.appName);

const props = defineProps({
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
  policySchemaOrg: Object,
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
const policySchema = computed(() => props.policySchemaOrg);
</script>
<style scoped>
  
</style>