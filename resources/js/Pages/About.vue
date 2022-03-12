<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const fired = () => {
    swal.fire('Hello Vue world!!!');
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-bold leading-tight text-gray-800">About</h2>
        </template>
        <Swal />
        <div class="mt-8 rounded-lg bg-white/30 py-4">
            <div class="h-96 p-8">Will setup About content here.</div>
            <button @click="fired">Click</button>
        </div>
    </AuthLayout>
</template>
