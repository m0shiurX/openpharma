<script setup>
import { computed } from 'vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <BreezeGuestLayout>

        <Head title="Email Verification" />

        <div class="mb-4 text-gray-600 text-sm">Thanks for signing up! Before getting started, could you verify your
            email address by clicking on the link we just emailed to you? If you didn't receive the email, we will
            gladly send you another.</div>

        <div class="mb-4 font-medium text-green-600 text-sm" v-if="verificationLinkSent">A new verification link has
            been sent to the email address you provided during registration.</div>

        <form @submit.prevent="submit">
            <div class="flex justify-between items-center mt-4">
                <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Resend
                    Verification Email </BreezeButton>

                <Link :href="route('logout')" method="post" as="button"
                    class="text-gray-600 text-sm hover:text-gray-900 underline">Log Out</Link>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
