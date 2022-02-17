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
                                <text-input
                                    v-model="form.password"
                                    :error="form.errors.password"
                                    class="w-full pb-8 pr-6 lg:w-1/2"
                                    type="password"
                                    autocomplete="new-password"
                                    label="Password"
                                />
                                <file-input
                                    v-model="form.photo"
                                    :error="form.errors.photo"
                                    class="w-full pb-8 pr-6 lg:w-1/2"
                                    type="file"
                                    accept="image/*"
                                    label="Photo"
                                />
                            </div>
                            <div class="flex items-center border-t border-gray-100 bg-gray-50 px-8 py-4">
                                <loading-button :loading="form.processing" class="ml-auto rounded-sm bg-slate-900 px-4 py-2 text-white" type="submit"
                                    >Update User</loading-button
                                >
                            </div>
                        </form>

                        <form @submit.prevent="update">
                            <div class="group relative z-0 mb-6 w-full">
                                <input
                                    type="text"
                                    name="name"
                                    id="floating_name"
                                    class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                                    placeholder=" "
                                    required=""
                                    v-model="form.name"
                                />
                                <label
                                    for="floating_name"
                                    class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500"
                                    >Full Name</label
                                >
                            </div>
                            <div class="group relative z-0 mb-6 w-full">
                                <input
                                    type="email"
                                    name="email"
                                    id="floating_email"
                                    class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                                    placeholder=" "
                                    required=""
                                    v-model="form.email"
                                />
                                <label
                                    for="floating_email"
                                    class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500"
                                    >Email</label
                                >
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="group relative z-0 mb-6 w-full">
                                    <input
                                        type="password"
                                        name="password"
                                        id="floating_password"
                                        class="peer password-sm block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                                        placeholder=""
                                        required=""
                                        v-model="form.password"
                                    />
                                    <label
                                        for="floating_password"
                                        class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500"
                                        >Password</label
                                    >
                                </div>
                                <div class="group relative z-0 mb-6 w-full">
                                    <input
                                        type="password"
                                        name="floating_confirm_password"
                                        id="floating_confirm_password"
                                        class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                                        placeholder=" "
                                        required=""
                                    />
                                    <label
                                        for="floating_confirm_password"
                                        class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500"
                                        >Confirm Password</label
                                    >
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="group relative z-0 mb-6 flex w-full items-center space-x-6">
                                    <div class="shrink-0">
                                        <img
                                            class="h-16 w-16 rounded-full object-cover"
                                            src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1361&q=80"
                                            alt="Current profile photo"
                                        />
                                    </div>
                                    <label class="block">
                                        <span class="sr-only">Choose profile photo</span>
                                        <input
                                            v-on:change="form.photo"
                                            type="file"
                                            accept="image/*"
                                            class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:bg-violet-50 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-violet-700 hover:file:bg-violet-100"
                                        />
                                    </label>
                                </div>
                                <div class="mb-6 flex w-full items-start justify-end">
                                    <button
                                        type="submit"
                                        class="w-full rounded-md bg-slate-700 px-8 py-2.5 text-center text-sm font-medium text-white hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800 sm:w-auto"
                                    >
                                        Update Users
                                    </button>
                                </div>
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
