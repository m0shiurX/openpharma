<template>
    <!-- Whitespace & wrapper around the app -->
    <div class="min-h-screen w-full gap-5 p-2 pr-4 md:grid md:grid-cols-12">
        <!-- Side navigation menu -->
        <aside class="rounded-xls w-full bg-white shadow-sm md:col-span-3 2xl:col-span-2">
            <div class="flex items-center justify-between rounded-md md:justify-center md:rounded-b-none">
                <!-- Logo -->
                <Link class="px-4 py-4 md:py-6">
                    <h1 class="text-2xl font-extrabold text-slate-600">OpenPharma</h1>
                </Link>
                <button class="pr-4 md:hidden" @click="showingNavigationDrawer = !showingNavigationDrawer">
                    <svg class="h-6 w-6 fill-slate-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
                <!-- Mobile Menu -->
                <teleport to="body">
                    <div class="fixed top-0 left-0 w-full bg-slate-500/30 md:hidden" @click="showingNavigationDrawer = false">
                        <MainMenu class="h-screen w-4/5 rounded-r-md bg-white px-0 pt-12" v-if="showingNavigationDrawer" @click.prevent.stop />
                    </div>
                </teleport>
            </div>

            <!-- Desktop Menu -->
            <MainMenu class="hidden pt-6 md:block md:rounded-b-md" />
        </aside>
        <main class="w-full md:col-span-9 2xl:col-span-10">
            <!-- Header navigation -->
            <header class="mb-5 mt-2 flex w-full items-center justify-between rounded-xl bg-white px-5 py-4 shadow-sm md:mt-0">
                <slot name="header" />
                <BreezeDropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex items-center rounded-md">
                            <img
                                v-if="$page.props.auth.user.photo"
                                class="mr-1 inline-flex h-8 w-8 rounded-full object-cover ring-1 ring-orange-100 ring-offset-2"
                                :src="$page.props.auth.user.photo"
                            />
                            <button
                                type="button"
                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                            >
                                {{ $page.props.auth.user.name }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <BreezeDropdownLink :href="route('profile')"> My Profile </BreezeDropdownLink>
                        <BreezeDropdownLink :href="route('logout')" method="post" as="button"> Log Out </BreezeDropdownLink>
                    </template>
                </BreezeDropdown>
            </header>
            <!-- Slot -->
            <div scroll-region>
                <slot />
            </div>
        </main>
    </div>
</template>

<script setup>
// Components
import { Link } from '@inertiajs/inertia-vue3';
import Icon from '@/Shared/Icon';
import Logo from '@/Shared/Logo';
import MainMenu from '@/Shared/MainMenu';
import { ref } from 'vue';

import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';

defineProps({
    auth: Object,
});

const showingNavigationDrawer = ref(false);
</script>
