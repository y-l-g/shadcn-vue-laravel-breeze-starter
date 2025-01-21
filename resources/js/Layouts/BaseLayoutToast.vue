<script setup lang="ts">
import Header from '@/Components/Header.vue';
import Toaster from '@/Components/ui/toast/Toaster.vue';

</script>
<template>
    <slot />
    <Toaster></Toaster>
</template>
