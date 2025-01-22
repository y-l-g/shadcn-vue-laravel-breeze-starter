<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

defineProps<{
    mustVerifyEmail?: Boolean;
    status?: String;
}>();

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.post(route('login'), {
        preserveScroll: true,
        onFinish: () => {
            form.reset();
        },
    });
};

</script>
<template>
    <Card class="mx-auto w-11/12 sm:w-4/6 max-w-[500px]">
        <CardHeader class="
        relative">
            <CardTitle class="text-2xl">
                Profile Information
            </CardTitle>
            <CardDescription>
                Update your account's profile information and email address.
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
                            autofocus
                            autocomplete="email"
                        />
                        <InputError :message="form.errors.email" />
                    </div>

                    <Button
                        class="w-full"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Save
                    </Button>
                    <div v-if="mustVerifyEmail && user.email_verified_at === null">
                        <p>
                            Your email address is unverified.
                            <Link
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                            >
                            Click here to re-send the verification email.
                            </Link>
                        </p>

                        <div v-show="status === 'verification-link-sent'">
                            A new verification link has been sent to your email address.
                        </div>
                    </div>
                </div>
            </form>
        </CardContent>
    </Card>
</template>
