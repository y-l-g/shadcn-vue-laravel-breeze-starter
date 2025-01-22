<script setup lang="ts">
import Logo from '@/Components/Logo.vue';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { useDark, useToggle } from '@vueuse/core';
import { SunIcon, MoonIcon } from '@radix-icons/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import Checkbox from '@/Components/ui/checkbox/Checkbox.vue';
const isDark = useDark()
const toggleDark = useToggle(isDark)

defineOptions({ layout: null });

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
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
                    Login
                </CardTitle>
                <CardDescription>
                    Enter your email below to login to your account
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit">

                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="email"
                            />
                            <InputError :message="form.errors.email" />
                        </div>
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
                            <div class="flex gap-2 items-center">
                                <Checkbox v-model:checked="form.remember" />
                                <label
                                    for="remember"
                                    class="text-sm text-muted-foreground"
                                >Remember Me</label>
                            </div>
                        </div>
                        <Button
                            class="w-full"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Login
                        </Button>
                        <Button
                            as="a"
                            variant="outline"
                            class="w-full"
                            icon="pi pi-google"
                            :href="route('google.redirect')"
                        >
                            Login with Google
                        </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Don't have an account?
                        <Link
                            :href="route('register')"
                            class="underline"
                        >
                        Sign up
                        </Link>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
