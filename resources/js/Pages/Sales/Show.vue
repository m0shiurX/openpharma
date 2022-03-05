<template>
    <Head title="Manufacturers" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">{{ sale.invoice_no }}</h2>
        </template>

        <div class="mt-8 rounded-lg bg-white/30 py-8">
            <div class="rounded-lg px-4 md:px-8 xl:px-10">
                <div class="w-lg mx-auto max-w-lg" ref="printDiv">
                    <div class="text-xs">
                        <!-- Shop Info -->
                        <div class="text-center">
                            <h1 class="text-sm font-bold">Akota Pharma</h1>
                            <p>Dada Vai Bhaban, Uposhohor</p>
                            <p>Bogura - 5800</p>
                            <p class="font-semibold">+880 1711 111 222</p>
                        </div>

                        <!-- Invoice Info -->
                        <div class="mx-2 flex justify-between">
                            <div><span class="font-bold">Invoice no: </span> # {{ sale.invoice_no }}</div>
                            <div><span class="font-bold">Date: </span> # {{ sale.sales_date }}</div>
                        </div>

                        <!-- Customer Info -->
                        <div class="mx-2 mt-3">
                            <div><span class="font-bold"> Name:</span> {{ sale.customer_name }}</div>
                            <div><span class="font-bold"> Phone:</span> {{ sale.customer_phone }}</div>
                            <div><span class="font-bold"> Address:</span> {{ sale.customer_address }}</div>
                        </div>

                        <!-- Invoice Table -->
                        <div class="mt-3">
                            <table class="w-full table-fixed bg-slate-200">
                                <thead>
                                    <tr class="h-10 border border-gray-100 bg-gray-50">
                                        <th class="border-x border-gray-100">SL</th>
                                        <th class="border-x border-gray-100 pl-5 text-left">Item</th>
                                        <th class="border-x border-gray-100">Qty</th>
                                        <th class="border-x border-gray-100">Rate</th>
                                        <th class="border-x border-gray-100">Amount</th>
                                    </tr>
                                    <tr class="h-1"></tr>
                                </thead>

                                <tbody>
                                    <template v-for="(item, index) in sale.sales_items" :key="index">
                                        <tr class="h-10 border border-gray-100 bg-gray-50 text-center">
                                            <td class="border-x border-gray-100">{{ index }}</td>
                                            <td class="border-r border-gray-100 pl-5 text-left">{{ item.medicine_id }}</td>
                                            <td class="border-r border-gray-100">{{ item.quantity }}</td>
                                            <td class="border-r border-gray-100">{{ item.selling_price }}</td>
                                            <td class="border-r border-gray-100">{{ item.total_price }}</td>
                                        </tr>
                                        <tr class="h-1"></tr>
                                    </template>
                                </tbody>
                                <tfoot>
                                    <tr class="h-10 border border-gray-100 bg-gray-50">
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Sub Total</div>
                                        </th>
                                        <th colspan="1" class="border-r border-gray-100">
                                            {{ sale.sub_total }}
                                        </th>
                                    </tr>
                                    <tr class="h-10 border border-gray-100 bg-gray-50">
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Invoice Discount</div>
                                        </th>
                                        <th colspan="1" class="border-r border-gray-100">
                                            {{ sale.invoice_discount }}
                                        </th>
                                    </tr>
                                    <tr class="h-10 border border-gray-100 bg-gray-50">
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">VAT</div>
                                        </th>
                                        <th colspan="1" class="border-r border-gray-100">
                                            {{ sale.vat }}
                                        </th>
                                    </tr>
                                    <tr class="h-10 border border-gray-100 bg-gray-50">
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Grand Total</div>
                                        </th>
                                        <th colspan="1" class="border-r border-gray-100">
                                            {{ sale.grand_total }}
                                        </th>
                                    </tr>
                                    <tr class="h-10 border border-gray-100 bg-gray-50">
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Paid Total</div>
                                        </th>
                                        <th colspan="1" class="border-r border-gray-100">
                                            {{ sale.paid_amount }}
                                        </th>
                                    </tr>
                                    <tr class="h-10 border border-gray-100 bg-gray-50">
                                        <th colspan="4" class="border-x border-gray-100">
                                            <div class="flex items-center justify-end pr-5">Exchange Total</div>
                                        </th>
                                        <th colspan="1" class="border-r border-gray-100">
                                            {{ sale.exchange_amount }}
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Credits -->
                        <div class=""></div>
                    </div>
                    <div class="mt-6 print:hidden">
                        <div class="flex items-center justify-end space-x-5">
                            <Link :href="route('sales.index')" as="button" tabindex="0" class="rounded-md bg-green-500 px-8 py-2 text-white">
                                Back
                            </Link>
                            <button type="button" @click="printItem" class="rounded-md bg-orange-500 px-8 py-2 text-white">Print</button>
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
import { ref } from 'vue';
const props = defineProps({
    sale: Object,
});

// const destroyItem = () => {
//     if (confirm('Are you sure you want to delete?')) {
//         Inertia.delete(route('sales.destroy', props.sale.id));
//     }
// };
const printDiv = ref(null);

const printItem = () => {
    window.print();
    console.log('trying to print the invoice', printDiv.value);
};
</script>
