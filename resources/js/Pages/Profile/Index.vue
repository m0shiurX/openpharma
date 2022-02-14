<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";

defineProps({
    user: Object,
});
</script>

<template>
    <Head title="My Profile" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <img
                            v-if="user.photo"
                            class="block ml-4 w-24 h-24 rounded-full"
                            :src="user.photo"
                        />
                        <div>{{ user.name }}</div>
                        <div>{{ user.email }}</div>

                        <Link :href="route('profile.edit')">
                            Edit Profile
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
