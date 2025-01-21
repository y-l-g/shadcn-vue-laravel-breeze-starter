<script setup lang="ts">
import Header from '@/Components/Header.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <div class="flex min-h-screen flex-col bg-background">
        <Header />
        <slot />
    </div>
</template>
