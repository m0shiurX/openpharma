<template>
    <Head title="Customers" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Customers List</h2>
        </template>

        <div class="mt-8 rounded-lg bg-white/30 py-4">
            <div class="px-4 md:px-8 xl:px-10">
                <FlashMessages />
            </div>
            <div class="px-4 md:px-8 xl:px-10">
                <div class="flex items-center justify-between">
                    <SearchFilter v-model="form.search" class="mr-4 w-80 rounded-lg" @reset="resetSearch"></SearchFilter>

                    <Link
                        class="mt-4 inline-flex items-start justify-start rounded bg-orange-700 px-6 py-3 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:ring-offset-2 sm:mt-0"
                        :href="route('customers.create')"
                        ><span class="text-sm font-medium leading-none text-white">Add Customer</span>
                    </Link>
                </div>
            </div>
            <div class="rounded-lg px-4 md:px-8 xl:px-10">
                <div
                    class="scrollbar-thumb-rounded-full scrollbar-track-rounded-full mt-5 overflow-auto overflow-y-scroll scrollbar-thin scrollbar-track-orange-300 scrollbar-thumb-orange-700"
                >
                    <table class="w-full table-auto whitespace-nowrap">
                        <thead>
                            <tr tabindex="0" class="h-16 rounded-lg border border-gray-100 bg-white text-lg text-gray-500 focus:outline-none">
                                <th>
                                    <div class="ml-5 flex items-center">
                                        <div class="relative flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-sm bg-gray-200">
                                            <input placeholder="checkbox" type="checkbox" class="h-full w-full cursor-pointer" />
                                        </div>
                                    </div>
                                </th>
                                <th class="border-r border-gray-100 pl-5 text-left">Customer</th>
                                <th class="border-x border-gray-100 pl-5 text-left">Contact</th>
                                <th colspan="2" class="border-l border-gray-100">Action</th>
                            </tr>
                            <tr class="h-3"></tr>
                        </thead>
                        <tbody class="">
                            <template v-for="(customer, i) in props.customers.data" :key="customer.id">
                                <tr
                                    tabindex="0"
                                    class="group h-14 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                >
                                    <td>
                                        <div class="ml-5">
                                            <div class="relative flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-sm bg-gray-200">
                                                <input placeholder="checkbox" type="checkbox" class="h-full w-full cursor-pointer" />
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-r border-gray-100">
                                        <div class="flex items-center pt-3 pl-5">
                                            <p class="mr-2 text-lg font-medium leading-none text-gray-700">{{ customer.name }}</p>
                                        </div>
                                        <div class="flex items-center pt-2 pb-3 pl-5">
                                            <icon icon="location" class="h-4 w-4 stroke-slate-400" />
                                            <p class="ml-1 truncate text-base leading-none text-gray-400">{{ customer.address }}</p>
                                        </div>
                                    </td>
                                    <td class="border-r border-gray-100">
                                        <div class="flex items-center pt-2 pb-3 pl-5">
                                            <icon icon="phone" class="h-4 w-4 stroke-slate-400" />
                                            <p class="ml-1 text-base leading-none text-gray-400">{{ customer.phone }}</p>
                                        </div>
                                    </td>
                                    <td class="pl-5">
                                        <Link
                                            :href="route('customers.show', customer.id)"
                                            class="rounded bg-red-100 py-2 px-5 text-sm leading-none text-orange-900 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2"
                                        >
                                            See Details
                                        </Link>
                                    </td>
                                    <td>
                                        <div class="relative px-5 pt-2">
                                            <Menu as="div">
                                                <MenuButton>
                                                    <Icon icon="dots" />
                                                </MenuButton>

                                                <MenuItems class="absolute right-0 z-30 mr-2 flex w-24 flex-col rounded-md bg-white shadow">
                                                    <MenuItem v-slot="{ active }">
                                                        <Link
                                                            class="w-full cursor-pointer rounded-t-md py-4 px-4 text-xs hover:bg-orange-600 hover:text-white focus:text-orange-200 focus:outline-none"
                                                            :class="{ 'bg-orange-600 text-white': active }"
                                                            :href="route('customers.edit', customer.id)"
                                                            as="button"
                                                        >
                                                            Edit
                                                        </Link>
                                                    </MenuItem>
                                                    <MenuItem v-slot="{ active }">
                                                        <button
                                                            class="w-full cursor-pointer rounded-b-md py-4 px-4 text-xs hover:bg-orange-600 hover:text-white focus:text-orange-200 focus:outline-none"
                                                            :class="{ 'bg-orange-600 text-white': active }"
                                                            @click="destroyItem(customer.id)"
                                                        >
                                                            Delete
                                                        </button>
                                                    </MenuItem>
                                                </MenuItems>
                                            </Menu>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="h-1"></tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <Pagination class="mt-5" :links="props.customers.links" />
            </div>
        </div>
    </AuthLayout>
</template>
<script setup>
import { watch, ref, onMounted } from 'vue';
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Pagination from '@/Shared/Pagination';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import SearchFilter from '@/Shared/SearchFilter.vue';
import pickBy from 'lodash/pickBy';
import Icon from '@/Shared/Icon.vue';
import debounce from 'lodash/debounce';
import FlashMessages from '@/Shared/FlashMessages';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';

const props = defineProps({
    customers: Object,
    filters: Object,
});

const form = useForm({
    search: props.filters.search,
});

watch(
    form,
    debounce(() => {
        Inertia.get(route('customers.index'), pickBy(form), { preserveState: true, replace: true });
    }, 500),
);

const destroyItem = (item) => {
    console.log(item);
    Inertia.delete(route('customers.destroy', item));
};

const resetSearch = () => {
    form.reset();
};
</script>
