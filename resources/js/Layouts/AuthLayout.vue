<template>
    <!-- Whitespace & wrapper around the app -->
    <div class="gap-5 md:grid md:grid-cols-12 p-2 pr-4 w-full min-h-screen">
        <!-- Side navigation menu -->
        <aside class="print:hidden md:col-span-3 2xl:col-span-2 bg-white shadow-sm rounded-xls w-full">
            <div class="flex justify-between md:justify-center items-center rounded-md md:rounded-b-none">
                <!-- Logo -->
                <Link class="px-4 py-4 md:py-6">
                <h1 class="font-extrabold text-2xl text-slate-600">OpenPharma</h1>
                </Link>
                <button class="md:hidden pr-4" @click="showingNavigationDrawer = !showingNavigationDrawer">
                    <svg class="w-6 h-6 fill-slate-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
                <!-- Mobile Menu -->
                <teleport to="body">
                    <div class="top-0 left-0 fixed md:hidden bg-slate-500/30 w-full"
                        @click="showingNavigationDrawer = false">
                        <MainMenu class="bg-white px-0 pt-12 rounded-r-md w-4/5 h-screen" v-if="showingNavigationDrawer"
                            @click.prevent.stop />
                    </div>
                </teleport>
            </div>

            <!-- Desktop Menu -->
            <MainMenu class="md:block hidden pt-6 md:rounded-b-md" />
        </aside>
        <main class="md:col-span-9 2xl:col-span-10 w-full">
            <!-- Header navigation -->
            <header
                class="flex justify-between items-center print:hidden bg-white shadow-sm mt-2 md:mt-0 mb-5 px-5 py-4 rounded-xl w-full">
                <slot name="header" />
                <BreezeDropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex items-center rounded-md">
                            <img class="inline-flex mr-1 rounded-full w-8 h-8 object-cover ring-1 ring-orange-100 ring-offset-2"
                                :src="$page.props.auth.user.photo ?? '/storage/avatar.jpg'" />
                            <button type="button"
                                class="inline-flex items-center bg-white px-3 py-2 border border-transparent rounded-md font-medium text-gray-500 text-sm hover:text-gray-700 leading-4 transition duration-150 ease-in-out focus:outline-none">
                                {{ $page.props.auth.user.name }}

                                <svg class="-mr-0.5 ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <BreezeDropdownLink :href="route('profile')"> My Profile </BreezeDropdownLink>
                        <BreezeDropdownLink :href="route('logout')" method="post" as="button"> Log Out
                        </BreezeDropdownLink>
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
import { Link } from '@inertiajs/vue3';
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
