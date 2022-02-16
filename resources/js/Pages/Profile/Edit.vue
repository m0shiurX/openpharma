<template>
    <Head title="Edit Profile" />
    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Profile</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <form @submit.prevent="update">
                            <div class="-mb-8 -mr-6 flex flex-wrap p-8">
                                <text-input v-model="form.name" :error="form.errors.name" class="w-full pb-8 pr-6 lg:w-1/2" label="First name" />
                                <text-input v-model="form.email" :error="form.errors.email" class="w-full pb-8 pr-6 lg:w-1/2" label="Email" />
                                <text-input v-model="form.password" :error="form.errors.password" class="w-full pb-8 pr-6 lg:w-1/2" type="password" autocomplete="new-password" label="Password" />
                                <file-input v-model="form.photo" :error="form.errors.photo" class="w-full pb-8 pr-6 lg:w-1/2" type="file" accept="image/*" label="Photo" />
                            </div>
                            <div class="flex items-center border-t border-gray-100 bg-gray-50 px-8 py-4">
                                <loading-button :loading="form.processing" class="ml-auto rounded-sm bg-slate-900 px-4 py-2 text-white" type="submit">Update User</loading-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';

import TextInput from '@/Shared/TextInput';
import FileInput from '@/Shared/FileInput';
import LoadingButton from '@/Shared/LoadingButton';

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'put',
    name: props.user.name,
    email: props.user.email,
    password: '',
    photo: null,
});

const update = () => {
    form.post(`/profile/update`, {
        onSuccess: () => form.reset('password', 'photo'),
    });
};
</script>
