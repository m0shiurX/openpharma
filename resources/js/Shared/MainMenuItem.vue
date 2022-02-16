<template>
    <div class="w-full">
        <Link
            class="group flex items-center py-3 pl-4 uppercase group-hover:from-orange-50 group-hover:to-orange-100 group-hover:border-r-4 group-hover:border-orange-600"
            :class="
                active &&
                'bg-gradient-to-r from-orange-50 to-orange-100 border-r-4 border-orange-600'
            "
            :href="href"
        >
            <icon
                icon="dashboard"
                class="mr-2 w-4 h-4 group-hover:fill-orange-600"
                :class="active ? 'fill-orange-600' : 'fill-slate-400'"
            />
            <div
                class="group-hover:text-orange-600"
                :class="active ? 'text-orange-600' : 'text-slate-400'"
            >
                <slot />
            </div>
        </Link>
    </div>
</template>

<script setup>
// Components
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Shared/Icon";

defineProps(["href", "active"]);
</script>
