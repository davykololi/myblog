<template> 
        <div v-if="$page.props.flash.message" class="animate-pulse mx-8">
                <v-alert color="green">{{ $page.props.flash.message }}</v-alert>
        </div>

        <div v-if="$page.props.flash.error" class="animate-pulse">
                <v-alert color="green">{{ $page.props.flash.error }}</v-alert>
        </div>
</template>

<script setup>

</script>


