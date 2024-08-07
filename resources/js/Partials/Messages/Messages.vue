<template> 
<Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">       
        <div v-if="$page.props.flash.message" class="animate-pulse" role="alert">
                <p class="secondary-button">{{ $page.props.flash.message }}</p>
        </div>
</Transition>

<Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
        <div v-if="$page.props.flash.error" class="animate-pulse" role="alert">
                <p class="danger-button">{{ $page.props.flash.error }}</p>
        </div>
</Transition>
</template>
<script setup>

</script>

