<template>
    <Head title="Purchases" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">{{ purchase.invoice_no }}</h2>
        </template>

        <div class="mt-8 rounded-lg bg-white/30 py-8">
            <div class="rounded-lg px-4 md:px-8 xl:px-10">
                <div class="w-2xl mx-auto max-w-lg">
                    <h2 class="text-2xl font-bold">We cant wait to meet you!</h2>
                    <p class="mt-2 text-lg">Please fill in the details below so that we can get in contact with you.</p>
                    <div>
                        <pre>
                            {{ purchase }}
                        </pre>
                    </div>
                    <div class="mt-6">
                        <div class="flex items-center justify-end space-x-5">
                            <Link :href="route('purchases.index')" as="button" tabindex="0" class="rounded-md bg-green-500 px-8 py-2 text-white">
                                Back
                            </Link>
                            <button type="button" @click="destroyItem" class="rounded-md bg-orange-500 px-8 py-2 text-white">Delete</button>
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

const props = defineProps({
    purchase: Object,
});

const destroyItem = () => {
    if (confirm('Are you sure you want to delete?')) {
        Inertia.delete(route('purchases.destroy', props.purchase.id));
    }
};
</script>
