<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link
        class="block hover:bg-gray-100 focus:bg-gray-100 px-4 py-2 w-full text-gray-700 text-left text-sm leading-5 transition duration-150 ease-in-out focus:outline-none">
    <slot />
    </Link>
</template>
