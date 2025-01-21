<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { useToast } from '@/Components/ui/toast/use-toast'
const { toast } = useToast()
import { nextTick, ref } from 'vue';
import AlertDialog from '@/Components/ui/alert-dialog/AlertDialog.vue';
import AlertDialogTrigger from '@/Components/ui/alert-dialog/AlertDialogTrigger.vue';
import AlertDialogContent from '@/Components/ui/alert-dialog/AlertDialogContent.vue';
import AlertDialogHeader from '@/Components/ui/alert-dialog/AlertDialogHeader.vue';
import AlertDialogTitle from '@/Components/ui/alert-dialog/AlertDialogTitle.vue';
import AlertDialogDescription from '@/Components/ui/alert-dialog/AlertDialogDescription.vue';
import AlertDialogFooter from '@/Components/ui/alert-dialog/AlertDialogFooter.vue';
import AlertDialogCancel from '@/Components/ui/alert-dialog/AlertDialogCancel.vue';
import AlertDialogAction from '@/Components/ui/alert-dialog/AlertDialogAction.vue';

const form = useForm({
    password: '',
});
const open = ref(false)

const deleteUser = () => {
    open.value = true
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onError: () => form.reset(),
    });
};

const closeModal = () => {
    open.value = false
    form.clearErrors();
};


</script>
<template>
    <Card class="mx-auto w-11/12 sm:w-4/6 max-w-[500px]">
        <CardHeader class="relative">
            <CardTitle class="text-2xl">
                Delete Account
            </CardTitle>
            <CardDescription>
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Before deleting your account, please
                download any data or information that you wish to retain.
            </CardDescription>
        </CardHeader>
        <CardContent>
            <AlertDialog v-model:open="open">
                <AlertDialogTrigger as-child>
                    <Button
                        variant="destructive"
                        class="w-full"
                    >
                        Delete Account
                    </Button>
                </AlertDialogTrigger>
                <AlertDialogContent>
                    <AlertDialogHeader>
                        <AlertDialogTitle>
                            Are you sure you want to delete your account?
                        </AlertDialogTitle>
                        <AlertDialogDescription>
                            Once your account is deleted, all of its resources and data
                            will be permanently deleted. Please enter your password to
                            confirm you would like to permanently delete your account.
                        </AlertDialogDescription>
                    </AlertDialogHeader>
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="name">Password</Label>
                            <Input
                                id="password"
                                ref="passwordInput"
                                v-model="form.password"
                                type="password"
                                autocomplete="current-password"
                                @keyup.enter="deleteUser"
                            />
                            <InputError :message="form.errors.password" />
                        </div>

                    </div>
                    <AlertDialogFooter>
                        <AlertDialogCancel @click="closeModal">
                            Cancel
                        </AlertDialogCancel>
                        <AlertDialogAction
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="deleteUser"
                        >
                            Delete Account
                        </AlertDialogAction>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>
        </CardContent>
    </Card>
</template>
