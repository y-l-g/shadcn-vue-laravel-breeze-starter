<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const form = useForm({
    email: user.email,
});

const submit = () => {
    form.post(route('password.email'), {
    });
};

</script>
<template>
    <Card class="mx-auto w-11/12 sm:w-4/6 max-w-[500px]">
        <CardHeader class="relative">
            <CardTitle class="text-2xl">
                Reset Password
            </CardTitle>
            <CardDescription>
                You will receive a mail to set your new password
            </CardDescription>
        </CardHeader>
        <CardContent>
            <form @submit.prevent="submit">
                <Button
                    class="w-full"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Send Password Reset Link
                </Button>
            </form>
        </CardContent>
    </Card>
</template>
