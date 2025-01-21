<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { useToast } from '@/Components/ui/toast/use-toast'

const { toast } = useToast()
import { ref } from 'vue';

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            toast({
                title: "Password has been changed",
            });
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value?.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value?.focus();
            }
        },
    });
};
</script>
<template>
    <Card class="mx-auto w-11/12 sm:w-4/6 max-w-[500px]">
        <CardHeader class="relative">
            <CardTitle class="text-2xl">
                Update Password
            </CardTitle>
            <CardDescription>
                Ensure your account is using a long, random password to stay
                secure.
            </CardDescription>
        </CardHeader>
        <CardContent>
            <form @submit.prevent="updatePassword">

                <div class="grid gap-4">
                    <div class="grid gap-2">
                        <Label for="name">Current password</Label>
                        <Input
                            id="current_password"
                            ref="currentPasswordInput"
                            v-model="form.current_password"
                            type="password"
                            required
                            autocomplete="current-password"
                        />
                        <InputError :message="form.errors.current_password" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="name">New password</Label>
                        <Input
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            required
                            autocomplete="new-password"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="name">Confirm password</Label>
                        <Input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
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
                        Save
                    </Button>
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm"
                    >
                        Saved.
                    </p>
                </div>
            </form>
        </CardContent>
    </Card>
</template>
