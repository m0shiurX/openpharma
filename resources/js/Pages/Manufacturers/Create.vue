<template>
    <Head title="Manufacturers" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Create New Manufacturer</h2>
        </template>

        <div class="mt-8 rounded-lg bg-white/30 py-8">
            <div class="rounded-lg px-4 md:px-8 xl:px-10">
                <form class="" @submit.prevent="saveManufacturers">
                    <div class="w-2xl mx-auto max-w-lg">
                        <h2 class="text-2xl font-bold">We cant wait to meet you!</h2>
                        <p class="mt-2 text-lg">Please fill in the details below so that we can get in contact with you.</p>
                        <div class="mt-6">
                            <BaseInput label="Name" v-model="form.name" :error="form.errors.name" class="" />
                            <BaseInput label="Location" v-model="form.location" :error="form.errors.location" class="" />
                            <BaseInput label="Contact Name" v-model="form.contact_name" :error="form.errors.contact_name" class="" />
                            <BaseInput label="Contact Tel" v-model="form.contact_tel" :error="form.errors.contact_tel" class="" />

                            <div class="flex items-center justify-end space-x-5">
                                <Link @click="reset" :href="route('manufacturers.index')" class="rounded-md bg-slate-400 px-8 py-2 text-white"
                                    >Cancel</Link
                                >
                                <button @click="saveManufacturers" class="rounded-md bg-orange-500 px-8 py-2 text-white" :disabled="form.processing">
                                    Save
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

const form = useForm({
    name: '',
    location: '',
    contact_name: '',
    contact_tel: '',
});

const saveManufacturers = () => {
    form.post(route('manufacturers.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset('password'),
    });
};
const reset = () => {
    form.reset();
};
</script>
