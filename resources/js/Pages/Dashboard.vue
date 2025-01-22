<script setup lang="ts">
import Header from '@/Components/Header.vue';
import Card from '@/Components/ui/card/Card.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <div class="flex min-h-screen flex-col bg-background">
        <Header />
        <Card class="p-10 m-10">Here you are! On the Dashboard!</Card>
    </div>
</template>
