<template>
  <Head>   
    <title v-once>{{ title }}</title>
    <meta v-once name="description" :content="desc">
    <meta v-once name="keywords" :content="keyw">
    <meta v-once name="robots" :content="robots">
    <meta v-once name="googlebot" :content="robots">
    <link v-once rel="canonical" :href="canonUrl">
    <meta v-once property="og:title" :content="tle + ' ' + '-' + ' ' + appName">
    <meta v-once property="og:description" :content="desc">
    <meta v-once property="og:type" :content="siteType" >
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

    <guest-layout>
      <template #header>
        <BreadcrumbView :breadcrumbview="breadcrumbsJsonld" v-memo/>
      </template>
      <SchemaOrg :schemaorg="aboutUsSchema" v-memo/>
      <BreadcrumbsJsonld :jsonldbreadcrumbs="headBreadcrumb"/>
      <MainPage class="w-full">
          <h2 class="h2-gradient" v-once>{{ title }}</h2>
          <div class="flex flex-col md:flex-row lg:flex-row">
            <div class="w-full md:w-1/2 lg:w-1/2">
              <img src="/static/lensa.jpg" class="p-4"/>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-2 p-4">
                <div class="bg-green-700">1</div>
                <div class="bg-red-700">2</div>
                <div class="bg-blue-700">3</div>
              </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/2">mmmmmm</div>
          </div>
      </MainPage>
    </guest-layout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import FrontendSidebar from '@/Partials/Sidebars/FrontendSidebar.vue';
import MainPage from '@/Partials/MainPage/MainPage.vue';
import Breadcrumb from '@/Partials/Breadcrumbs/Breadcrumb.vue';
import BreadcrumbView from '@/Partials/Breadcrumbs/BreadcrumbView.vue';
import BreadcrumbsJsonld from '@/Partials/Breadcrumbs/BreadcrumbsJsonld.vue';
import SchemaOrg from '@/Partials/SchemaOrg/SchemaOrg.vue';
import { Head, Link, usePage} from "@inertiajs/vue3";
import { computed } from 'vue';
const page = usePage();
const appName = computed(() => page.props.appName);
const breadcrumbsJsonld = computed(() => page.props.breadcrumbs);

const props = defineProps({
  title: String,
  description: String,
  keywords: String,
  canonical_url: String,
  robots: String,
  site_type: String,
  site_url: String,
  site_secure_url: String,
  site_name: String,
  twitter_card: String,
  site_creator: String,
  aboutSchemaOrg: Object,
  aboutJsonLdBreadcrumb: Object,
});

const tle = computed(() => props.title);
const desc = computed(() => props.description);
const keyw = computed(() => props.keywords);
const canonUrl = computed(() => props.canonical_url);
const robots = computed(() => props.robots);
const siteType = computed(() => props.site_type);
const siteUrl = computed(() => props.site_url);
const siteSecureUrl = computed(() => props.site_secure_url);
const siteName = computed(() => props.site_name);
const twitterCard = computed(() => props.twitter_card);
const twitterSite = computed(() => props.site_creator);
const siteCreator = computed(() => props.site_creator);
const aboutUsSchema = computed(() => props.aboutSchemaOrg);
const headBreadcrumb = computed(() => props.aboutJsonLdBreadcrumb);

</script>
<style lang="scss" scoped></style>