<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <AuthLayout>
        <template #header>
            <h2 class="font-semibold text-gray-800 text-xl leading-tight">Dashboard</h2>
        </template>

        <div class="bg-white/30 mt-8 py-4 rounded-lg">
            <div class="p-8 h-96">Will setup dashboard widgets here.</div>
        </div>
    </AuthLayout>
</template>
