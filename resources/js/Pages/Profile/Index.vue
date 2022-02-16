<template>
    <Head title="My Profile" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">My Profile</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <img v-if="user.photo" class="ml-4 block h-24 w-24 rounded-full object-cover" :src="user.photo" />
                        <div>{{ user.name }}</div>
                        <div>{{ user.email }}</div>

                        <Link :href="route('profile.edit')"> Edit Profile </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';

defineProps({
    user: Object,
});
</script>
