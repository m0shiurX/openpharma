<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="flex min-h-screen flex-col items-center bg-slate-700 pt-6 sm:justify-center sm:pt-0">
        <div>
            <Link href="/">
                <BreezeApplicationLogo class="text-3xl font-bold text-white" />
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-slate-50 px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
