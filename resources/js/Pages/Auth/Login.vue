<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BreezeGuestLayout>

        <Head title="Log in" />
        <div class="font-bold text-2xl text-center text-slate-700">
            <h2>Log in</h2>
            <div class="mx-auto my-4 border-b-2 w-24"></div>
        </div>
        <BreezeValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-green-600 text-sm">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="block mt-1 w-full" v-model="form.email" required autofocus
                    autocomplete="username" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="block mt-1 w-full" v-model="form.password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-gray-600 text-sm">Remember me</span>
                </label>
            </div>

            <div class="flex justify-end items-center mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')"
                    class="text-gray-600 text-sm hover:text-gray-900 underline"> Forgot your password? </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Log
                    in </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
