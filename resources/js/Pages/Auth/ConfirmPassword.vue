<script setup lang="ts">
import Logo from '@/Components/Logo.vue';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { useDark, useToggle } from '@vueuse/core';
import { SunIcon, MoonIcon, GithubLogoIcon } from '@radix-icons/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import Checkbox from '@/Components/ui/checkbox/Checkbox.vue';

import { useToast } from '@/Components/ui/toast/use-toast'

const { toast } = useToast()
const isDark = useDark()
const toggleDark = useToggle(isDark)

defineOptions({ layout: null });

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset('password');
        },
        onSuccess: () => {
            toast({
                title: "Thank you for confirming your password",
            });
        }
    });
};


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
                    Confirm your password
                </CardTitle>
                <CardDescription>
                    This is a secure area of the application. Please confirm your
                    password before continuing.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit">

                    <div class="grid gap-4">

                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <Label for="password">Password</Label>
                                <Link
                                    :href="route('password.request')"
                                    class="text-right align pl-3 ml-auto inline-block text-sm underline"
                                >
                                Forgot your password?
                                </Link>
                            </div>
                            <Input
                                id="password"
                                type="password"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                            <InputError :message="form.errors.password" />
                        </div>
                        <Button
                            class="w-full"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Confirm your password
                        </Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
