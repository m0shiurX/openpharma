<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <BreezeGuestLayout>

        <Head title="Forgot Password" />

        <div class="font-bold text-2xl text-center text-slate-700">
            <h2>Forgot your password?</h2>
            <div class="mx-auto my-4 border-b-2 w-24"></div>
        </div>

        <div class="mb-4 text-gray-600 text-sm">No problem. Just let us know your email address and we will email you a
            password reset link that will allow you to choose a new one.</div>

        <div v-if="status" class="mb-4 font-medium text-green-600 text-sm">
            {{ status }}
        </div>

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="block mt-1 w-full" v-model="form.email" required autofocus
                    autocomplete="username" />
            </div>

            <div class="flex justify-between items-center mt-4">
                <Link :href="route('login')" class="flex items-center text-gray-600 text-sm hover:text-gray-900">
                <svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Login
                </Link>

                <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Email Password
                    Reset Link </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
