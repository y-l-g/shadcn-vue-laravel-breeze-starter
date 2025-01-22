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
const isDark = useDark()
const toggleDark = useToggle(isDark)

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});
const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};


</script>



<template>

    <Head title="Register" />
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
                    Register
                </CardTitle>
                <CardDescription>
                    Enter your informations below to register
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit">

                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input
                                id="name"
                                type="text"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError :message="form.errors.name" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                v-model="form.email"
                                required
                                autocomplete="email"
                            />
                            <InputError :message="form.errors.email" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="password">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                            <InputError :message="form.errors.password" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="password_confirmation">Confirm Password</Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                            />
                            <InputError :message="form.errors.password_confirmation" />
                        </div>
                        <Button
                            class="w-full"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Register
                        </Button>

                        <Button
                            as="button"
                            :asChild="!form.processing"
                            variant="outline"
                            class="w-full"
                            icon="pi pi-google"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            <Link
                                :href="route('google.redirect')"
                                class="w-full"
                            >
                            Register with Google
                            </Link>
                        </Button>

                    </div>
                    <div class="mt-4 text-center text-sm">
                        Already registered?
                        <Link
                            :href="route('login')"
                            class="underline"
                        >
                        Login
                        </Link>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
