<script setup lang="ts">
import Toaster from '@/Components/ui/toast/Toaster.vue';
import { useToast } from '@/Components/ui/toast/use-toast'
import { usePage } from '@inertiajs/vue3';
import { watch } from 'vue';
const { toast } = useToast()

watch(() => usePage().props.flash.message, (newMessage) => {
    if (newMessage) {
        toast({
            title: newMessage,
        })
    }
}, { deep: true });

</script>
<template>
    <slot />
    <Toaster></Toaster>
</template>
