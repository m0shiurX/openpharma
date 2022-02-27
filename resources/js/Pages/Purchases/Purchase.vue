<template>
    <Head title="Customers" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Purchase #{{ invoice_no }}</h2>
        </template>

        <div class="mt-8 rounded-lg bg-white/30 py-8">
            <div class="rounded-lg px-4 md:px-8 xl:px-10">
                <!-- Form -->
                <div class="">
                    <div class="w-3xl mx-auto max-w-3xl">
                        <!-- Invoice header-->
                        <div class="mb-6 rounded-xl border border-orange-100 py-3 px-5">
                            <div class="flex items-center justify-between divide-x-2">
                                <div class="flex flex-1 items-center pr-2">
                                    <Icon icon="hash" class="h-10 w-8 stroke-orange-300" />
                                    <div class="ml-2 flex flex-col">
                                        <span class="text-xs font-semibold text-slate-400"> #{{ invoice_no }}</span>
                                        <span class="text-sm text-slate-500"> {{ display_date }} </span>
                                    </div>
                                </div>
                                <div class="flex flex-1 items-center pl-2">
                                    <Icon icon="manufacturer" class="h-8 w-8 stroke-orange-300" />
                                    <div class="ml-2 flex flex-col">
                                        <span class="text-sm font-semibold text-slate-500">{{ manufacturer.name }}</span>
                                        <span class="text-xs text-slate-400">{{ manufacturer.location }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <!-- Purchase info -->
                            <div class="mb-3 flex gap-x-2">
                                <div class="flex-1">
                                    <label class="mb-2 block" for="manufacturer"> Manufacturer</label>
                                    <select
                                        class="h-10 w-full appearance-none rounded-md border border-orange-300 bg-orange-50 text-slate-900 focus:border-orange-400 focus:ring-orange-400"
                                        v-model="form.manufacturer_id"
                                        id="manufacturer"
                                    >
                                        <option value="" selected>Select a Manufacturer</option>
                                        <option v-for="manufacturer in props.manufacturers" :key="manufacturer.id" :value="manufacturer.id">
                                            {{ manufacturer.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label class="mb-2 block" for="purchase_date">Purchase Date</label>
                                    <input
                                        id="purchase_date"
                                        v-model="form.purchase_date"
                                        type="date"
                                        onkeydown="return false"
                                        class="h-10 w-full appearance-none rounded-md border border-orange-300 bg-orange-50 text-slate-900 focus:border-orange-400 focus:outline-none focus:ring-orange-400 sm:text-sm"
                                        required
                                        disabled
                                    />
                                </div>
                            </div>

                            <!-- Medicine search -->

                            <div class="relative flex-1">
                                <label class="mb-2 block" for="medicine">Type to search medicine</label>
                                <input
                                    name="search"
                                    v-model="search"
                                    placeholder="Napa"
                                    type="text"
                                    autocomplete="off"
                                    class="mb-5 h-10 w-full rounded-md border border-orange-400 bg-orange-50 placeholder:text-slate-300 focus:border focus:border-orange-400 focus:ring-orange-600"
                                    @keydown.up.prevent="highlightPrevious"
                                    @keydown.down.prevent="highlightNext"
                                    @focus="searchResultShown = true"
                                    @keydown.esc="searchResultShown = false"
                                    @input="softResetSearch"
                                    @keydown.enter.prevent="selectItem"
                                />
                                <div
                                    v-if="search.length > 0"
                                    class="absolute top-9 right-0 mr-3 cursor-pointer text-2xl text-gray-600 hover:text-gray-800"
                                    @click="resetSearch"
                                >
                                    &times;
                                </div>
                                <transition name="fade">
                                    <div v-if="search.length > 0 && searchResultShown" class="absolute top-20 left-0 z-50 w-full">
                                        <ul
                                            class="mt-1 w-full overflow-auto rounded-md bg-orange-200 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        >
                                            <li
                                                v-for="(medicine, index) in filteredMedicine"
                                                :key="medicine.id"
                                                class="relative w-full cursor-pointer py-2 pl-10 pr-4 text-gray-900 focus:bg-green-200"
                                                role="option"
                                                tabindex="-1"
                                                value="0"
                                                :class="{ 'bg-blue-300': index === highlightedIndex }"
                                                @click="selectItem(index)"
                                            >
                                                <span class="block font-normal">{{ medicine.name }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </transition>
                            </div>

                            <!-- Main table -->
                            <table class="w-full table-auto whitespace-nowrap">
                                <thead>
                                    <tr class="h-12 rounded-lg border border-gray-100 bg-white text-base text-gray-500 focus:outline-none">
                                        <th class="border-r border-gray-100 pl-5 text-left">Medicine</th>
                                        <th class="border-x border-gray-100 pl-5 text-left">BATCH</th>
                                        <th class="border-x border-gray-100 pl-5 text-left">Qty</th>
                                        <th class="border-x border-gray-100 pl-5 text-left">Rate</th>
                                        <th class="border-x border-gray-100 pl-5 text-left">MRP</th>
                                        <th class="border-x border-gray-100 pl-5 text-left">Total</th>
                                        <th class="border-l border-gray-100"></th>
                                    </tr>
                                    <tr class="h-2"></tr>
                                </thead>
                                <tbody class="">
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <td class="border-r border-gray-100">
                                            <div class="flex h-full items-center pl-5">Napa</div>
                                        </td>
                                        <td class="border-r border-gray-100">
                                            <div class="flex h-full items-center pl-5">B21-4</div>
                                        </td>
                                        <td class="border-r border-gray-100">
                                            <div class="flex h-full items-center pl-5">50</div>
                                        </td>
                                        <td class="border-r border-gray-100">
                                            <div class="flex h-full items-center pl-5">5</div>
                                        </td>
                                        <td class="border-r border-gray-100">
                                            <div class="flex h-full items-center pl-5">6</div>
                                        </td>
                                        <td class="border-r border-gray-100">
                                            <div class="flex h-full items-center justify-end pr-3">250.00</div>
                                        </td>
                                        <td class="w-12">
                                            <button
                                                type="button"
                                                class="inline-flex h-full w-12 justify-center rounded bg-red-100 py-2.5 px-3 text-center text-sm leading-none text-orange-900 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2"
                                            >
                                                <Icon icon="close" class="h-5 w-5 stroke-orange-300" />
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="h-2"></tr>

                                    <template v-for="(formRow, index) in formRows" :key="index">
                                        <tr
                                            class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                        >
                                            <td class="border-r border-gray-100">
                                                <div class="flex h-full items-center pl-5">{{ formRow.name }} - {{ formRow.strength }}</div>
                                            </td>
                                            <td class="border-r border-gray-100">
                                                <div class="flex h-full items-center pl-5">B21-4</div>
                                            </td>
                                            <td class="border-r border-gray-100">
                                                <div class="flex h-full items-center pl-5">50</div>
                                            </td>
                                            <td class="border-r border-gray-100">
                                                <div class="flex h-full items-center pl-5">{{ formRow.purchase_price }}</div>
                                            </td>
                                            <td class="border-r border-gray-100">
                                                <div class="flex h-full items-center pl-5">{{ formRow.selling_price }}</div>
                                            </td>
                                            <td class="border-r border-gray-100">
                                                <div class="flex h-full items-center justify-end pr-3">00.00</div>
                                            </td>
                                            <td class="w-12">
                                                <button
                                                    @click="removeItem(index)"
                                                    type="button"
                                                    class="inline-flex h-full w-12 justify-center rounded bg-red-100 py-2.5 px-3 text-center text-sm leading-none text-orange-900 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2"
                                                >
                                                    <Icon icon="close" class="h-5 w-5 stroke-orange-300" />
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="h-2"></tr>
                                    </template>
                                </tbody>
                                <tfoot>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Sub Total</div>
                                        </th>
                                        <th colspan="2" class="w-12 border-r border-gray-100">
                                            <input
                                                type="text"
                                                v-model="form.sub_total"
                                                class="h-full w-full border-0 bg-orange-50 pr-16 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                    </tr>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Discount</div>
                                        </th>
                                        <th colspan="2" class="w-12 border-r border-gray-100">
                                            <input
                                                type="text"
                                                v-model="form.discount"
                                                class="h-full w-full border-0 bg-orange-50 pr-16 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                    </tr>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">VAT</div>
                                        </th>
                                        <th colspan="2" class="w-12 border-r border-gray-100">
                                            <input
                                                type="text"
                                                v-model="form.vat"
                                                class="h-full w-full border-0 bg-orange-50 pr-16 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                    </tr>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Grand Total</div>
                                        </th>
                                        <th colspan="2" class="w-12 border-r border-gray-100">
                                            <input
                                                type="text"
                                                v-model="form.grand_total"
                                                class="h-full w-full border-0 bg-orange-50 pr-16 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                    </tr>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Paid Total</div>
                                        </th>
                                        <th colspan="2" class="w-12 border-r border-gray-100">
                                            <input
                                                type="text"
                                                v-model="form.paid_amount"
                                                class="h-full w-full border-0 bg-orange-50 pr-16 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                    </tr>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Due Total</div>
                                        </th>
                                        <th colspan="2" class="w-12 border-r border-gray-100">
                                            <input
                                                type="text"
                                                v-model="form.due_amount"
                                                class="h-full w-full border-0 bg-orange-50 pr-16 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- Form actions -->
                            <div class="mt-5 flex flex-row-reverse items-center justify-start gap-x-5">
                                <button @click="saveItem" class="rounded-md bg-orange-500 px-8 py-2 text-white" :disabled="form.processing">
                                    Save
                                </button>
                                <button @click="reset" class="rounded-md bg-slate-400 px-8 py-2 text-white">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>
<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import BaseInput from '@/Shared/BaseInput.vue';
import Icon from '@/Shared/Icon.vue';
import { ref, computed, watch } from 'vue';
import moment from 'moment';
import debounce from 'lodash/debounce';
import axios from 'axios';

const props = defineProps({
    invoice_no: String,
    manufacturers: Object,
});
const form = useForm({
    invoice_no: props.invoice_no,
    purchase_date: moment().format('YYYY-MM-DD'),
    manufacturer_id: '',
    sub_total: 0.0,
    vat: 0.0,
    discount: 0.0,
    grand_total: 0.0,
    paid_amount: 0.0,
    due_amount: 0.0,
    purchase_items: [
        // {
        //     medicine_id: Number,
        //     medicine_name: String,
        //     batch_id: String,
        //     expiry_date: String,
        //     quantity: Number,
        //     purchase_price: Number,
        //     selling_price: Number,
        //     total_price: Number,
        // },
    ],
});

// Purchase date
const display_date = computed({
    get() {
        if (moment(form.purchase_date).isValid()) {
            return moment(form.purchase_date).format('LL');
        } else {
            return moment().format('LL');
        }
    },
});

// Manufacturers
const manufacturer = ref({
    id: 1,
    name: 'Select a Manufacturer',
    location: 'Manufacturer Address',
});

const changeManufacturer = (id) => {
    let detail = props.manufacturers.find((item) => item.id === id);
    if (detail) {
        manufacturer.value = detail;
    }
};

watch(
    () => form.manufacturer_id,
    (manufacturer_id) => changeManufacturer(manufacturer_id),
);

// Medicines

const search = ref('');
const filteredMedicine = ref([]);
const selectedMedicine = ref();

watch(
    search,
    debounce((txt) => {
        txt.length > 1 &&
            axios
                .get(route('purchases.medicine'), {
                    params: { query: txt },
                })
                .then((result) => (filteredMedicine.value = result.data));
    }, 500),
);

const searchResultShown = ref(false);
const highlightedIndex = ref(0);

const resetSearch = () => {
    search.value = '';
    highlightedIndex.value = 0;
};
const softResetSearch = () => {
    searchResultShown.value = true;
    highlightedIndex.value = 0;
};

const selectItem = () => {
    let item = filteredMedicine.value[highlightedIndex.value];
    selectedMedicine.value = item;
    resetSearch();
};
const clickedItem = (index) => {
    let item = filteredMedicine.value[index];
    selectedMedicine.value = item;
    resetSearch();
};
const highlightNext = () => {
    if (highlightedIndex.value < filteredMedicine.value.length - 1) {
        highlightedIndex.value++;
    } else {
        highlightedIndex.value = 0;
    }
};
const highlightPrevious = () => {
    highlightedIndex.value > 0 && highlightedIndex.value--;
};

// Manage table rows with form
const formRows = ref([]);
watch(selectedMedicine, (item) => {
    formRows.value.push(item);
});
const removeItem = (index) => {
    formRows.value.splice(index, 1);
};

// Form Actions
const saveItem = () => {
    form.post(route('purchases.store'), {
        preserveScroll: true,
    });
};
const reset = () => {
    form.reset();
};
</script>
