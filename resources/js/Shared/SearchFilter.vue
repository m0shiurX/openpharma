<template>
    <div class="flex items-center">
        <div class="flex w-full rounded bg-white shadow">
            <input
                class="focus:shadow-outline relative w-full rounded-r px-6 py-3"
                autocomplete="off"
                type="text"
                name="search"
                placeholder="Search…"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
            />
        </div>
        <button class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500" type="button" @click="$emit('reset')">Reset</button>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: String,
        maxWidth: {
            type: Number,
            default: 300,
        },
    },
    emits: ['update:modelValue', 'reset'],
};
</script>
