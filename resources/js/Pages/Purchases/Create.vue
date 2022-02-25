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
                            <div class="mb-5 flex gap-x-2">
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
                                <label class="mb-2 block" for="medicine">Medicine</label>
                                <input
                                    name="search"
                                    v-model="search"
                                    placeholder="Type to start"
                                    type="text"
                                    class="mb-5 h-10 w-full rounded-md border border-orange-400 bg-orange-50 focus:border focus:border-orange-400 focus:ring-orange-600"
                                />

                                <!-- <div v-if="medicines?.data?.length > 0" class="absolute top-20 left-0 z-50 w-1/2 bg-orange-500 py-2 pl-2 pr-10">
                                    <ul v-for="medicine in medicines.data" :key="medicine.id">
                                        <li>{{ medicine.name }}</li>
                                    </ul>
                                </div> -->
                            </div>
                            <table class="w-full table-auto whitespace-nowrap">
                                <thead>
                                    <tr class="h-12 rounded-lg border border-gray-100 bg-white text-base text-gray-500 focus:outline-none">
                                        <th class="border-r border-gray-100 pl-5 text-left">Medicine</th>
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

const display_date = computed({
    get() {
        if (moment(form.purchase_date).isValid()) {
            return moment(form.purchase_date).format('LL');
        } else {
            return moment().format('LL');
        }
    },
});

const manufacturer = ref({
    id: 1,
    name: 'Select a Manufacturer',
    location: 'Manufacturer Address',
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
        {
            medicine_id: '',
            batch_id: '',
            expiry_date: '',
            quantity: 0,
            purchase_price: 0,
            selling_price: 0,
            total_price: 0,
        },
    ],
});

const search = ref('');
const medicines = ref([]);
const searchMedicine = () => {};

watch(
    search,
    debounce((changed_item) => {
        axios.get(route('purchases.medicine'), { params: { query: changed_item } }).then((data) => (medicines.value = data));
    }, 1000),
);

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

const saveItem = () => {
    form.post(route('purchases.store'), {
        preserveScroll: true,
    });
};

const reset = () => {
    form.reset();
};
</script>
