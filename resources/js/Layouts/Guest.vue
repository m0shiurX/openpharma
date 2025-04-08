<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex flex-col sm:justify-center items-center bg-slate-700 pt-6 sm:pt-0 min-h-screen">
        <div>
            <Link href="/">
            <BreezeApplicationLogo class="font-bold text-3xl text-white" />
            </Link>
        </div>

        <div class="bg-slate-50 shadow-md mt-6 px-6 py-4 sm:rounded-lg w-full sm:max-w-md overflow-hidden">
            <slot />
        </div>
    </div>
</template>
