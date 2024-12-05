<template>
  <Splide :options="options" aria-label="My Favorite Images">
    <SplideSlide v-if="$props.articles.length != 0" v-for="article in $props.articles" :key="article.id">
          <img :src="article.image_url" :alt="article.title" class="lg:h-24 md:h-24 w-full md:w-48 object-cover object-center scale-110 transition-all duration-400 hover:scale-100 justify-center">
    </SplideSlide>
  </Splide>
</template>

<script setup>
import { Splide, SplideSlide } from '@splidejs/vue-splide';

const props = defineProps({
                articles: Object,
});

const options = {
      rewind: true,
      gap   : '1rem',
    };
</script>