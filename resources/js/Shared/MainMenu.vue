<template>
    <div class="space-y-4">
        <MainMenuItem href="/dashboard" icon="dashboard" :active="isUrl('dashboard')">Dashboard</MainMenuItem>
        <MainMenuItem href="/manufacturers" icon="manufacturer" :active="isUrl('manufacturers')">Manufacturers</MainMenuItem>
        <MainMenuItem href="/customers" icon="manufacturer" :active="isUrl('customers')">Customers</MainMenuItem>
        <MainMenuItem href="/profile" icon="factorys" :active="isUrl('profile')">Profile</MainMenuItem>
        <MainMenuItem href="/about" icon="office" :active="isUrl('about')">About</MainMenuItem>
    </div>
</template>

<script setup>
// Helpers
import { Inertia } from '@inertiajs/inertia';

// Components
import MainMenuItem from './MainMenuItem.vue';

const isUrl = (...urls) => {
    let currentUrl = Inertia.page.url.substring(1);
    if (urls[0] === '') {
        return currentUrl === '';
    }
    return urls.filter((url) => currentUrl.startsWith(url)).length;
};
</script>
