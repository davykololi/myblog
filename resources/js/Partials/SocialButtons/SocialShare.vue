<template>
<div class="mb-4">
  <div class="flex items-center">
    <hr class="flex-grow border-t border-blue-500">
    <span class="px-3 text-red-700 font-bold uppercase">
      Share This Article:
    </span>
    <hr class="flex-grow border-t border-blue-500">
  </div>

  <div v-html="share" class="text-center"></div>
</div>
</template>

<script setup>
const props = defineProps({
  share: String,
})
</script>