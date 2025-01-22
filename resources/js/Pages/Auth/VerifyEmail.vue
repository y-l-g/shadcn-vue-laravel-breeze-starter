<script setup lang="ts">
import Logo from '@/Components/Logo.vue';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { useDark, useToggle } from '@vueuse/core';
import { SunIcon, MoonIcon } from '@radix-icons/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import { computed } from 'vue';
const isDark = useDark()
const toggleDark = useToggle(isDark)

defineOptions({ layout: null });

const props = defineProps<{
    status?: string;
}>();

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'), {});
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);

</script>
<template>

    <Head title="Log in" />
    <div class="p-2 flex flex-col justify-center items-center gap-8 min-w-[100vw] min-h-[100vh]">
        <Link href="/">
        <Logo class="w-16 h-16 stroke-primary fill-primary" />
        </Link>
        <Card class="mx-auto max-w-sm">
            <CardHeader class="relative">
                <Button
                    class="w-9 h-9 absolute top-0 right-0 hover:bg-transparent"
                    aria-label="Toggle dark mode"
                    :variant="'ghost'"
                    :size="'icon'"
                    @click="toggleDark()"
                >
                    <component
                        :is="isDark ? SunIcon : MoonIcon"
                        class="w-5 h-5 text-foreground"
                    />
                </Button>

                <CardTitle class="text-2xl">
                    Verify Email
                </CardTitle>
                <CardDescription>
                    Thanks for signing up! Before getting started, could you verify your
                    email address by clicking on the link we just emailed to you? If you
                    didn't receive the email, we will gladly send you another.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <Button
                            class="w-full"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Verify Email
                        </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                        >Log Out</Link>
                    </div>
                </form>
            </CardContent>
        </Card>
        <p v-if="verificationLinkSent">
            A new verification link has been sent to the email address you
            provided during registration.
        </p>
    </div>
</template>
