<template>
    <Head title="Customers" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Purchase #{{ invoice_no }}</h2>
        </template>

        <div class="mt-8 rounded-lg bg-white/30 py-8">
            <div class="rounded-lg px-4 md:px-8 xl:px-10">
                <!-- Form -->
                <form class="" @submit.prevent="saveItem">
                    <div class="w-4xl mx-auto max-w-4xl">
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
                                    <div class="mb-2 max-w-full">
                                        <label class="mb-2 block" for="manufacturer"> Manufacturer</label>
                                        <v-select
                                            class="h-full bg-orange-100"
                                            placeholder="Choose a Manufacturer"
                                            v-model="form.manufacturer_id"
                                            :options="props.manufacturers"
                                            :reduce="(manufacturer) => manufacturer.id"
                                            label="name"
                                        />
                                    </div>
                                    <!-- <label class="mb-2 block" for="manufacturer"> Manufacturer</label>
                                    <select
                                        class="h-10 w-full appearance-none rounded-md border border-orange-300 bg-orange-50 text-slate-900 focus:border-orange-400 focus:ring-orange-400"
                                        v-model="form.manufacturer_id"
                                        id="manufacturer"
                                        required
                                    >
                                        <option value="" selected>Select a Manufacturer</option>
                                        <option v-for="manufacturer in props.manufacturers" :key="manufacturer.id" :value="manufacturer.id">
                                            {{ manufacturer.name }}
                                        </option>
                                    </select> -->
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
                                    <div
                                        v-if="search.length > 0 && searchResultShown"
                                        class="absolute top-20 left-0 z-50 h-96 w-full overflow-y-auto rounded-b-lg rounded-t-sm"
                                    >
                                        <ul
                                            class="mt-1 w-full overflow-auto rounded-md bg-orange-100 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        >
                                            <li
                                                v-for="(medicine, index) in filteredMedicine"
                                                :key="medicine.id"
                                                class="relative w-full cursor-pointer border-y border-orange-200 py-2 pl-10 pr-4 text-slate-900 hover:border-y hover:border-orange-300 hover:bg-orange-200 focus:bg-orange-200"
                                                role="option"
                                                tabindex="-1"
                                                value="0"
                                                :class="{ 'border-y border-orange-400 bg-orange-200': index === highlightedIndex }"
                                                @click="clickedItem(index)"
                                            >
                                                <span class="block font-normal capitalize">{{ medicine.name }} - {{ medicine.strength }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </transition>
                            </div>

                            <!-- Main table -->
                            <table class="w-full table-auto whitespace-nowrap">
                                <thead>
                                    <tr class="h-12 rounded-lg border border-gray-100 bg-white text-base text-gray-500 focus:outline-none">
                                        <th class="border-r border-gray-100 pl-5 pr-2 text-left">Medicine</th>
                                        <th class="w-32 border-x border-gray-100 pl-5 text-left">BATCH</th>
                                        <th class="w-32 border-x border-gray-100 pl-5 text-left">Expiry</th>
                                        <th class="w-32 border-x border-gray-100 pl-5 text-left">Qty</th>
                                        <th class="w-32 border-x border-gray-100 pl-5 text-left">Rate</th>
                                        <th class="w-32 border-x border-gray-100 pl-5 text-left">MRP</th>
                                        <th class="W-20 border-x border-gray-100 pl-3 pr-2 text-left">VAT</th>
                                        <th class="w-32 border-x border-gray-100 pl-5 pr-3 text-left">Total</th>
                                        <th class="border-l border-gray-100">ACT</th>
                                    </tr>
                                    <tr class="h-2"></tr>
                                </thead>
                                <tbody class="">
                                    <template v-for="(formRow, index) in form.purchase_items" :key="index">
                                        <tr
                                            class="group h-10 rounded border border-orange-200 bg-orange-50 transition-colors duration-200 ease-in hover:bg-orange-100"
                                        >
                                            <td class="h-10 border-gray-100">
                                                <div class="flex h-full flex-col items-start justify-center bg-slate-100 px-2 capitalize">
                                                    {{ formRow.name }} <br />
                                                    <span class="block truncate text-xs">{{ formRow.strength }}</span>
                                                </div>
                                            </td>
                                            <td class="h-10 w-32 border-gray-100">
                                                <input
                                                    required
                                                    type="text"
                                                    @focus="$event.target.select()"
                                                    @input="formRow.batch_id = $event.target.value.toUpperCase()"
                                                    v-model.trim="formRow.batch_id"
                                                    class="h-full w-full border-0 border-x border-orange-200 bg-orange-50 pr-3 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                                />
                                            </td>
                                            <td class="h-10 w-32 border-gray-100">
                                                <input
                                                    required
                                                    type="date"
                                                    v-model="formRow.expiry_date"
                                                    :max="moment().add(5, 'y').format('YYYY-MM-DD')"
                                                    :min="moment().format('YYYY-MM-DD')"
                                                    class="h-full w-full border-0 border-x border-orange-200 bg-orange-50 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                                />
                                            </td>
                                            <td class="h-10 w-32 border-gray-100">
                                                <input
                                                    min="1"
                                                    @focus="$event.target.select()"
                                                    type="number"
                                                    v-model.number="formRow.quantity"
                                                    class="h-full w-full border-0 border-r border-orange-200 bg-orange-50 px-1 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                                />
                                            </td>
                                            <td class="h-10 w-32 border-gray-100">
                                                <input
                                                    disabled
                                                    type="number"
                                                    step="0.01"
                                                    v-model.number="formRow.purchase_price"
                                                    class="h-full w-full border-0 border-r border-orange-200 bg-slate-100 px-1 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                                />
                                            </td>
                                            <td class="h-10 w-32 border-gray-100">
                                                <input
                                                    @focus="$event.target.select()"
                                                    type="number"
                                                    step="0.01"
                                                    v-model.number="formRow.selling_price"
                                                    class="h-full w-full border-0 border-r border-orange-200 bg-orange-50 px-1 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                                />
                                            </td>
                                            <td class="h-10 w-20 border-gray-100">
                                                <input
                                                    disabled
                                                    type="number"
                                                    step="0.01"
                                                    v-model.number="formRow.vat"
                                                    class="h-full w-full border-0 border-r border-orange-200 bg-slate-100 px-1 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                                />
                                            </td>
                                            <td class="h-10 w-32 border-gray-100">
                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    @focus="$event.target.select()"
                                                    v-model.number="formRow.total_price"
                                                    class="h-full w-full border-0 border-orange-200 bg-orange-50 px-1 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                                />
                                            </td>
                                            <td class="w-12 p-0">
                                                <button
                                                    @click="removeItem(index)"
                                                    type="button"
                                                    class="inline-flex h-full w-12 justify-center bg-red-100 py-2.5 px-3 text-center text-sm leading-none text-orange-900 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2"
                                                >
                                                    <Icon icon="close" class="h-5 w-5 stroke-orange-300" />
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="h-2">
                                            <td colspan="8" v-if="Object.keys(form.errors).length > 0">
                                                <p class="pl-2 text-xs text-red-400">
                                                    {{ form.errors['purchase_items.' + index + '.batch_id'] }}
                                                </p>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                                <tfoot>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="7" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Sub Total</div>
                                        </th>
                                        <th colspan="1" class="w-12 border-r border-gray-100">
                                            <input
                                                disabled
                                                type="number"
                                                step="0.01"
                                                v-model="form.sub_total"
                                                class="h-full w-full border-0 bg-slate-100 pr-3 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                        <th class="w-12 text-xs font-light">BDT</th>
                                    </tr>

                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="7" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">VAT</div>
                                        </th>
                                        <th colspan="1" class="w-12 border-r border-gray-100">
                                            <input
                                                @focus="$event.target.select()"
                                                type="number"
                                                step="0.01"
                                                v-model="form.vat"
                                                class="h-full w-full border-0 bg-orange-50 pr-3 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                        <th class="w-12 text-xs font-light">%</th>
                                    </tr>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="7" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">VAT Total</div>
                                        </th>
                                        <th colspan="1" class="w-12 border-r border-gray-100">
                                            <input
                                                disabled
                                                type="number"
                                                step="0.01"
                                                v-model="form.vat_total"
                                                class="h-full w-full border-0 bg-slate-100 pr-3 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                        <th class="w-12 text-xs font-light">BDT</th>
                                    </tr>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="7" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Invoice Discount</div>
                                        </th>
                                        <th colspan="1" class="w-12 border-r border-gray-100">
                                            <input
                                                @focus="$event.target.select()"
                                                type="number"
                                                step="0.01"
                                                v-model="form.discount"
                                                class="h-full w-full border-0 bg-orange-50 pr-3 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                        <th class="w-12 text-xs font-light">BDT</th>
                                    </tr>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="7" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Grand Total</div>
                                        </th>
                                        <th colspan="1" class="w-12 border-r border-gray-100">
                                            <input
                                                disabled
                                                type="number"
                                                step="0.01"
                                                v-model="form.grand_total"
                                                class="h-full w-full border-0 bg-slate-100 pr-3 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                        <th class="w-12 text-xs font-light">BDT</th>
                                    </tr>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="7" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Paid Amount</div>
                                        </th>
                                        <th colspan="1" class="w-12 border-r border-gray-100">
                                            <input
                                                @focus="$event.target.select()"
                                                type="number"
                                                step="0.01"
                                                v-model="form.paid_amount"
                                                class="h-full w-full border-0 bg-orange-50 pr-3 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                        <th class="w-12 text-xs font-light">BDT</th>
                                    </tr>
                                    <tr
                                        class="group h-10 rounded border border-gray-100 bg-gray-50 transition-colors duration-200 ease-in hover:bg-gray-300"
                                    >
                                        <th colspan="7" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Due Amount</div>
                                        </th>
                                        <th colspan="1" class="w-12 border-r border-gray-100">
                                            <input
                                                disabled
                                                type="number"
                                                step="0.01"
                                                v-model="form.due_amount"
                                                class="h-full w-full border-0 bg-slate-100 pr-3 text-right focus:border focus:border-orange-400 focus:ring-orange-600"
                                            />
                                        </th>
                                        <th class="w-12 text-xs font-light">BDT</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- Form actions -->
                            <div class="mt-5 flex flex-row-reverse items-center justify-start gap-x-5">
                                <button type="submit" class="rounded-md bg-orange-500 px-8 py-2 text-white" :disabled="form.processing">Save</button>
                                <button type="button" @click="saveItem" class="rounded-md bg-slate-400 px-8 py-2 text-white">Save & Print</button>
                            </div>
                        </div>
                    </div>
                </form>
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
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

const props = defineProps({
    invoice_no: String,
    manufacturers: Object,
});
const form = useForm({
    invoice_no: props.invoice_no,
    purchase_date: moment().format('YYYY-MM-DD'),
    manufacturer_id: null,
    sub_total: 0,
    vat: 17.4,
    discount: 0,
    vat_total: 0,
    grand_total: 0,
    paid_amount: 0,
    due_amount: 0,
    purchase_items: [],
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
    if (filteredMedicine.value.length > 0) {
        let item = filteredMedicine.value[highlightedIndex.value];
        selectedMedicine.value = item;
        resetSearch();
    }
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
watch(selectedMedicine, (item) => {
    item.total_price = 0;
    item.quantity = 0;
    item.vat = 0;
    item.purchase_price = 0;
    item.batch_id = '';
    item.expiry_date = moment().add(2, 'y').format('YYYY-MM-DD');
    form.purchase_items.push(item);
});

// Calculate fields
watch(
    () => form.purchase_items,
    (items) => {
        items.map((item) => {
            let vat = (parseFloat(item.total_price) / 100) * form.vat;
            let rate = (parseFloat(item.total_price) + vat) / item.quantity;

            return [(item.vat = Number(vat).toFixed(2)), (item.purchase_price = rate ? Number(rate).toFixed(2) : 0)];
        });
    },
    { deep: true },
);

// Sub total
form.sub_total = computed({
    get() {
        // if (form.purchase_items.length > 0)
        return Number(form.purchase_items.reduce((accumulator, current) => accumulator + parseFloat(current.total_price), 0).toFixed(2));
    },
});

// Purchase date
form.grand_total = computed({
    get() {
        if (form.purchase_items.length == 0) return 0;
        if (!isNaN(form.discount) && form.discount > 0) {
            return Number(Math.round(form.sub_total - form.discount + form.vat_total)).toFixed(2);
        } else {
            return Number(Math.round(form.sub_total + form.vat_total)).toFixed(2);
        }
    },
});

form.vat_total = computed({
    get() {
        if (form.purchase_items.length == 0) return 0;
        if (form.vat == 0) return 0;

        return Number(form.purchase_items.reduce((accumulator, current) => accumulator + parseFloat(current.vat), 0).toFixed(2));
    },
});

form.due_amount = computed({
    get() {
        if (!isNaN(form.paid_amount) && form.paid_amount > 0) {
            return Number(form.grand_total - form.paid_amount).toFixed(2);
        } else {
            return form.grand_total;
        }
    },
});

const removeItem = (index) => {
    form.purchase_items.splice(index, 1);
};

// Form Actions
const saveItem = () => {
    form.post(route('purchases.store'), {
        preserveScroll: true,
    });
};
const reset = () => {
    form.purchase_items = [];
    form.reset();
};

// Animation
const beforeLeave = (el) => {
    const { marginLeft, marginTop, width, height } = window.getComputedStyle(el);
    el.style.left = `${el.offsetLeft - parseFloat(marginLeft, 10)}px`;
    el.style.top = `${el.offsetTop - parseFloat(marginTop, 10)}px`;
    el.style.width = width;
    el.style.height = height;
};
</script>
