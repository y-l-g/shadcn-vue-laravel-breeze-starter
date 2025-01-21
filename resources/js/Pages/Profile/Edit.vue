<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>

<template>

    <Head title="Log in" />
    <Header />
    <div class="py-10 flex flex-col justify-center items-center gap-8 min-w-[100vw] min-h-[100vh]">
        <UpdateProfileInformationForm
            :must-verify-email="mustVerifyEmail"
            :status="status"
        />
        <UpdatePasswordForm />
        <DeleteUserForm />
    </div>

</template>
