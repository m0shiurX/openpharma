<template>
    <Head title="Manufacturers" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Manufacturers List</h2>
        </template>

        <div class="mt-8 rounded-lg bg-white/30 py-4">
            <div class="px-4 md:px-8 xl:px-10">
                <div class="flex items-center justify-between">
                    <SearchFilter v-model="form.search" class="mr-4 w-80 rounded-lg" @reset="reset"></SearchFilter>
                    <button
                        class="mt-4 inline-flex items-start justify-start rounded bg-orange-700 px-6 py-3 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:ring-offset-2 sm:mt-0"
                    >
                        <p class="text-sm font-medium leading-none text-white">Add Manufacturer</p>
                    </button>
                </div>
            </div>
            <div class="rounded-lg px-4 md:px-8 xl:px-10">
                <!-- <div class="items-center justify-between py-3 sm:flex">
                    <div class="flex items-center">
                        <SearchFilter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset"></SearchFilter>
                        <a class="rounded-full focus:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-800" href="javascript:void(0)">
                            <div class="rounded-full bg-indigo-100 py-2 px-8 text-indigo-700">
                                <p>All</p>
                            </div>
                        </a>
                        <a
                            class="ml-4 rounded-full focus:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-800 sm:ml-8"
                            href="javascript:void(0)"
                        >
                            <div class="rounded-full py-2 px-8 text-gray-600 hover:bg-indigo-100 hover:text-indigo-700">
                                <p>Done</p>
                            </div>
                        </a>
                        <a
                            class="ml-4 rounded-full focus:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-800 sm:ml-8"
                            href="javascript:void(0)"
                        >
                            <div class="rounded-full py-2 px-8 text-gray-600 hover:bg-indigo-100 hover:text-indigo-700">
                                <p>Pending</p>
                            </div>
                        </a>
                    </div>
                    <div class="flex cursor-pointer items-center rounded py-3 px-4 text-sm font-medium leading-none text-gray-600">
                        <select aria-label="select" class="ml-1 bg-transparent focus:text-indigo-600 focus:outline-none">
                            <option class="text-sm text-indigo-800">Latest</option>
                            <option class="text-sm text-indigo-800">Oldest</option>
                            <option class="text-sm text-indigo-800">Latest</option>
                        </select>
                    </div>
                </div> -->
                <div
                    class="scrollbar-thumb-rounded-full scrollbar-track-rounded-full mt-5 overflow-auto overflow-y-scroll scrollbar-thin scrollbar-track-orange-300 scrollbar-thumb-orange-700"
                >
                    <table class="w-full table-auto whitespace-nowrap">
                        <thead>
                            <tr tabindex="0" class="h-10 rounded-lg border border-gray-100 bg-white focus:outline-none">
                                <th>
                                    <div class="ml-5 flex items-center">
                                        <div class="relative flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-sm bg-gray-200">
                                            <input placeholder="checkbox" type="checkbox" class="h-full w-full cursor-pointer" />
                                        </div>
                                    </div>
                                </th>
                                <th class="border-r pl-5 text-left">Name</th>
                                <th class="border-x pl-6 text-left">Location</th>
                                <th class="border-x pl-5 text-left">Contact Name</th>
                                <th class="border-x pl-5 text-left">Contact</th>
                                <th colspan="2" class="border-l">Action</th>
                            </tr>
                            <tr class="h-3"></tr>
                        </thead>
                        <tbody class="">
                            <template v-for="manufacturer in props.manufacturers.data" :key="manufacturer.id">
                                <tr tabindex="0" class="h-10 rounded border border-gray-100 bg-white focus:outline-none">
                                    <td>
                                        <div class="ml-5">
                                            <div class="relative flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-sm bg-gray-200">
                                                <input placeholder="checkbox" type="checkbox" class="h-full w-full cursor-pointer" />
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-r">
                                        <div class="flex items-center pl-5">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700">{{ manufacturer.name }}</p>
                                            <icon icon="link" />
                                        </div>
                                    </td>
                                    <td class="border-r pl-5">
                                        <div class="flex items-center">
                                            <icon icon="list" class="fill-red-500 stroke-red-500" />
                                            <p class="ml-2 text-sm leading-none text-gray-600">{{ manufacturer.location }}</p>
                                        </div>
                                    </td>
                                    <td class="border-r pl-5">
                                        <div class="flex items-center">
                                            <icon icon="message" class="stroke-slate-600" />
                                            <p class="ml-2 text-sm leading-none text-gray-600">{{ manufacturer.contact_name }}</p>
                                        </div>
                                    </td>
                                    <td class="border-r pl-5">
                                        <div class="flex items-center">
                                            <icon icon="attachment" class="stroke-orange-300" />
                                            <p class="ml-2 text-sm leading-none text-gray-600">{{ manufacturer.contact_tel }}</p>
                                        </div>
                                    </td>
                                    <td class="pl-5">
                                        <button
                                            class="rounded bg-red-100 py-2 px-5 text-sm leading-none text-orange-900 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2"
                                        >
                                            View
                                        </button>
                                    </td>
                                    <td>
                                        <div class="relative px-5 pt-2">
                                            <button class="rounded-md focus:outline-none focus:ring-2" role="button" aria-label="option">
                                                <icon icon="dots" />
                                            </button>
                                            <div class="dropdown-content absolute right-0 z-30 mr-6 hidden w-24 bg-white shadow">
                                                <div
                                                    tabindex="0"
                                                    class="w-full cursor-pointer py-4 px-4 text-xs hover:bg-indigo-700 hover:text-white focus:text-indigo-600 focus:outline-none"
                                                >
                                                    <p>Edit</p>
                                                </div>
                                                <div
                                                    tabindex="0"
                                                    class="w-full cursor-pointer py-4 px-4 text-xs hover:bg-indigo-700 hover:text-white focus:text-indigo-600 focus:outline-none"
                                                >
                                                    <p>Delete</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="h-3"></tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <Pagination class="mt-5" :links="props.manufacturers.links" />
            </div>
        </div>
    </AuthLayout>
</template>
<script setup>
import { watch, ref } from 'vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Pagination from '@/Shared/Pagination';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import SearchFilter from '@/Shared/SearchFilter.vue';
import pickBy from 'lodash/pickBy';
import Icon from '@/Shared/Icon.vue';
import debounce from 'lodash/debounce';

const props = defineProps({
    manufacturers: Object,
    filters: Object,
});

// onUpdated(() => {
//     console.log(props.manufacturers);
// });

const form = useForm({
    search: props.filters.search,
});

// const form = ref(props.filters.search);

watch(
    form,
    debounce(() => {
        Inertia.get(route('manufacturers.index'), pickBy(form), { preserveState: true, replace: true });
    }, 500),
);

const reset = () => {
    form.reset();
};
</script>
