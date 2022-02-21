<template>
    <Head title="Manufacturers" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Create New Manufacturer</h2>
        </template>

        <div class="mt-8 rounded-lg bg-white/30 py-4">
            <div class="rounded-lg px-4 md:px-8 xl:px-10">
                <form @submit.prevent="store">
                    <div class="-mb-8 -mr-6 flex flex-wrap p-8">
                        <text-input v-model="form.name" :error="form.errors.name" class="w-full pb-8 pr-6 lg:w-1/2" label="Name" />
                        <text-input v-model="form.email" :error="form.errors.email" class="w-full pb-8 pr-6 lg:w-1/2" label="Email" />
                        <text-input v-model="form.phone" :error="form.errors.phone" class="w-full pb-8 pr-6 lg:w-1/2" label="Phone" />
                        <text-input v-model="form.location" :error="form.errors.location" class="w-full pb-8 pr-6 lg:w-1/2" label="Address" />
                        <text-input v-model="form.city" :error="form.errors.city" class="w-full pb-8 pr-6 lg:w-1/2" label="City" />
                        <text-input v-model="form.region" :error="form.errors.region" class="w-full pb-8 pr-6 lg:w-1/2" label="Province/State" />
                        <select-input v-model="form.country" :error="form.errors.country" class="w-full pb-8 pr-6 lg:w-1/2" label="Country">
                            <option :value="null" />
                            <option value="CA">Canada</option>
                            <option value="US">United States</option>
                        </select-input>
                        <text-input
                            v-model="form.postal_code"
                            :error="form.errors.postal_code"
                            class="w-full pb-8 pr-6 lg:w-1/2"
                            label="Postal code"
                        />
                    </div>
                    <div class="flex items-center justify-end border-t border-gray-100 bg-gray-50 px-8 py-4">
                        <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Organization</loading-button>
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
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';
import LoadingButton from '@/Shared/LoadingButton';

const form = useForm({
    name: null,
    email: null,
    phone: null,
    location: null,
    city: null,
    region: null,
    country: null,
    postal_code: null,
});

const store = () => {
    form.post(route('manufacturers.store'));
};
</script>
