<template>
    <Head title="Manufacturers" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Adding a medicine</h2>
        </template>

        <div class="mt-8 rounded-lg bg-white/30 py-8">
            <div class="rounded-lg px-4 md:px-8 xl:px-10">
                <form class="" @submit.prevent="updateItem">
                    <div class="w-2xl mx-auto max-w-lg">
                        <!-- Form steps goes here -->
                        <div class="mb-6 rounded-xl border border-orange-100 py-3 px-5">
                            <div class="flex items-center justify-start divide-x-2">
                                <div class="flex items-center pr-2">
                                    <Icon icon="location" class="h-8 w-8 stroke-orange-300" />
                                    <div class="ml-2 flex hidden flex-col">
                                        <span class="text-xs text-slate-400">Step 1/3</span>
                                        <span class="text-sm text-slate-500"> Updating a medicine </span>
                                    </div>
                                </div>
                                <div class="flex items-center px-2">
                                    <Icon icon="location" class="h-8 w-8 stroke-orange-300" />
                                    <div class="ml-2 flex flex-col">
                                        <span class="text-xs text-slate-400">Step 2/3</span>
                                        <span class="text-sm text-slate-500"> Updating a medicine </span>
                                    </div>
                                </div>
                                <div class="flex items-center pl-2">
                                    <Icon icon="location" class="h-8 w-8 stroke-orange-300" />
                                    <div class="ml-2 flex hidden flex-col">
                                        <span class="text-xs text-slate-400">Step 3/</span>
                                        <span class="text-sm text-slate-500"> Updating a medicine </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold">We cant wait to meet you!</h2>
                        <p class="mt-2 text-base">Please fill in the details below so that we can get in contact with you.</p>
                        <div class="mt-6">
                            <BaseInput label="Name" v-model="form.name" :error="form.errors.name" class="" />
                            <BaseInput label="Generic Name" v-model="form.generic_name" :error="form.errors.generic_name" class="" />
                            <BaseInput label="Manufacturer" v-model="form.manufacturer_id" :error="form.errors.manufacturer_id" class="" />
                            <BaseInput label="Strength" v-model="form.strength" :error="form.errors.strength" class="" />
                            <BaseInput label="Category" v-model="form.category" :error="form.errors.category" class="" />
                            <BaseInput label="Unit" v-model="form.unit" :error="form.errors.unit" class="" />
                            <BaseInput label="Purchase Price" v-model="form.purchase_price" :error="form.errors.purchase_price" class="" />
                            <BaseInput label="Selling Price" v-model="form.selling_price" :error="form.errors.selling_price" class="" />
                            <BaseInput label="Discount (%)" v-model="form.discount" :error="form.errors.discount" class="" />

                            <div class="mt-8 flex items-center justify-end space-x-5">
                                <Link @click="reset" :href="route('manufacturers.index')" class="rounded-md bg-slate-400 px-8 py-2 text-white"
                                    >Cancel</Link
                                >
                                <button @click="updateItem" class="rounded-md bg-orange-500 px-8 py-2 text-white" :disabled="form.processing">
                                    Update
                                </button>
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

const props = defineProps({
    medicine: Object,
});

const form = useForm({
    name: props.medicine.name,
    generic_name: props.medicine.generic_name,
    manufacturer_id: props.medicine.manufacturer_id,
    strength: props.medicine.strength,
    category: props.medicine.category,
    unit: props.medicine.unit,
    purchase_price: props.medicine.purchase_price,
    selling_price: props.medicine.selling_price,
    discount: props.medicine.discount,
});

const updateItem = () => {
    form.put(route('medicines.update', props.medicine.id));
};

const reset = () => {
    form.reset();
};
</script>
