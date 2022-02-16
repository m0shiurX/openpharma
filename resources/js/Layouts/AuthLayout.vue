<template>
    <!-- Whitespace & wrapper around the app -->
    <div class="w-full md:grid gap-5 md:grid-cols-12 p-2 min-h-screen">
        <!-- Side navigation menu -->
        <aside class="w-full md:col-span-3 lg:col-span-2 rounded-md bg-white">
            <div
                class="flex items-center justify-between md:justify-center rounded-md md:rounded-b-none"
            >
                <!-- Logo -->
                <Link class="p-4">
                    <h1 class="text-2xl font-medium text-slate-900">
                        OpenPharma
                    </h1>
                </Link>
                <button
                    class="md:hidden"
                    @click="showingNavigationDrawer = !showingNavigationDrawer"
                >
                    <svg
                        class="w-6 h-6 fill-white"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
                <!-- Mobile Menu -->
                <teleport to="body">
                    <div
                        class="fixed top-0 left-0 w-full bg-slate-500/30 md:hidden"
                        @click="showingNavigationDrawer = false"
                    >
                        <MainMenu
                            class="pt-6 px-8 bg-slate-800 rounded-r-md w-4/5 h-screen"
                            v-if="showingNavigationDrawer"
                            @click.prevent.stop
                        />
                    </div>
                </teleport>
            </div>

            <!-- Desktop Menu -->
            <MainMenu class="hidden pt-6 md:block md:rounded-b-md" />
        </aside>
        <main class="w-full md:col-span-9 lg:col-span-10">
            <!-- Header navigation -->
            <header
                class="rounded-md w-full bg-purple-300 p-5 mb-5 mt-2 md:mt-0 flex items-center justify-between"
            >
                <slot name="header" />
                <BreezeDropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex items-center rounded-md">
                            <img
                                v-if="$page.props.auth.user.photo"
                                class="block mr-2 w-6 h-6 rounded-full object-cover"
                                :src="$page.props.auth.user.photo"
                            />
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                            >
                                {{ $page.props.auth.user.name }}

                                <svg
                                    class="ml-2 -mr-0.5 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
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
                        <BreezeDropdownLink :href="route('profile')">
                            My Profile
                        </BreezeDropdownLink>
                        <BreezeDropdownLink
                            :href="route('logout')"
                            method="post"
                            as="button"
                        >
                            Log Out
                        </BreezeDropdownLink>
                    </template>
                </BreezeDropdown>
            </header>
            <!-- Slot -->
            <div class="rounded-md bg-pink-200 p-3" scroll-region>
                <slot />
            </div>
        </main>
    </div>
</template>

<script setup>
// Components
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Shared/Icon";
import Logo from "@/Shared/Logo";
import MainMenu from "@/Shared/MainMenu";
import { ref } from "vue";

import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";

defineProps({
    auth: Object,
});

const showingNavigationDrawer = ref(false);
</script>
