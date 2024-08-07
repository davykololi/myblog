<template>
	<Head>   
    <title v-memo>{{ title }}</title>
    <meta v-memo name="description" :content="description">
    <meta v-memo name="keywords" :content="keywords">
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
    	<Breadcrumb :routelink="['blog',tag.articles + tag.slug,]" :text="['Blog', tag.name + ' ' + 'Articles',]"></Breadcrumb>
    </template>

    <SchemaOrg :schemaorg="tagSchema" v-memo/>

  	<MainPage>
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
import SchemaOrg from '@/Partials/SchemaOrg/SchemaOrg.vue';
import { Head, Link, usePage} from "@inertiajs/vue3";
const page = usePage();
import { computed } from 'vue';
const appName = computed(() => page.props.appName);

const props = defineProps({
			tag: Object,
      articles: Object,
			site_type: String,
			site_creator: String,
      tagSchemaOrg: Object,
		});

const title = computed(() => props.tag.name + " " + "Articles");
const description = computed(() => props.tag.description);
const keywords = computed(() => props.tag.keywords);
const canonUrl = computed(() => props.tag.absolute_url);
const siteType = computed(() => props.site_type);
const siteUrl = computed(() => props.tag.absolute_url);
const siteSecureUrl = computed(() => props.tag.absolute_url);
const twitterSite = computed(() => props.site_creator);
const siteCreator = computed(() => props.site_creator);
const tagSchema = computed(() => props.tagSchemaOrg);
</script>