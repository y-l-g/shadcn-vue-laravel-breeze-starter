<script setup lang="ts">
import Toaster from '@/Components/ui/toast/Toaster.vue';
import { useToast } from '@/Components/ui/toast/use-toast'
import { usePage } from '@inertiajs/vue3';
const { toast } = useToast()
const page = usePage()

if (page.props.flash.message) {
    toast({
        title: page.props.flash.message,
    })
};

</script>
<template>
    <slot />
    <Toaster></Toaster>
</template>
