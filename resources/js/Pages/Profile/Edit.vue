<template>
    <Head title="Edit Profile" />
    <AuthLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="update">
                            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                                <text-input
                                    v-model="form.name"
                                    :error="form.errors.name"
                                    class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="First name"
                                />
                                <text-input
                                    v-model="form.email"
                                    :error="form.errors.email"
                                    class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Email"
                                />
                                <text-input
                                    v-model="form.password"
                                    :error="form.errors.password"
                                    class="pb-8 pr-6 w-full lg:w-1/2"
                                    type="password"
                                    autocomplete="new-password"
                                    label="Password"
                                />
                                <file-input
                                    v-model="form.photo"
                                    :error="form.errors.photo"
                                    class="pb-8 pr-6 w-full lg:w-1/2"
                                    type="file"
                                    accept="image/*"
                                    label="Photo"
                                />
                            </div>
                            <div
                                class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100"
                            >
                                <loading-button
                                    :loading="form.processing"
                                    class="bg-slate-900 text-white rounded-sm px-4 py-2 ml-auto"
                                    type="submit"
                                    >Update User</loading-button
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import AuthLayout from "@/Layouts/AuthLayout.vue";

import TextInput from "@/Shared/TextInput";
import FileInput from "@/Shared/FileInput";
import LoadingButton from "@/Shared/LoadingButton";

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: "put",
    name: props.user.name,
    email: props.user.email,
    password: "",
    photo: null,
});

const update = () => {
    form.post(`/profile/update`, {
        onSuccess: () => form.reset("password", "photo"),
    });
};
</script>
