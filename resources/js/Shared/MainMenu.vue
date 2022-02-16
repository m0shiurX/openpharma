<template>
    <div class="space-y-2">
        <div class="w-full">
            <Link class="group flex items-center py-3" href="/dashboard">
                <icon
                    icon="dashboard"
                    class="mr-2 w-4 h-4"
                    :class="
                        isUrl('dashboard')
                            ? 'fill-white'
                            : 'fill-indigo-400 group-hover:fill-white'
                    "
                />
                <div
                    :class="
                        isUrl('dashboard')
                            ? 'text-white'
                            : 'text-indigo-300 group-hover:text-white'
                    "
                >
                    Dashboard
                </div>
            </Link>
        </div>
        <div>
            <Link class="group flex items-center py-3" href="/organizations">
                <icon
                    icon="office"
                    class="mr-2 w-4 h-4"
                    :class="
                        isUrl('profile')
                            ? 'fill-white'
                            : 'fill-indigo-400 group-hover:fill-white'
                    "
                />
                <div
                    :class="
                        isUrl('profile')
                            ? 'text-white'
                            : 'text-indigo-300 group-hover:text-white'
                    "
                >
                    Organizations
                </div>
            </Link>
        </div>
        <div>
            <Link class="group flex items-center py-3" href="/contacts">
                <icon
                    icon="users"
                    class="mr-2 w-4 h-4"
                    :class="
                        isUrl('contacts')
                            ? 'fill-white'
                            : 'fill-indigo-400 group-hover:fill-white'
                    "
                />
                <div
                    :class="
                        isUrl('contacts')
                            ? 'text-white'
                            : 'text-indigo-300 group-hover:text-white'
                    "
                >
                    Contacts
                </div>
            </Link>
        </div>
        <div>
            <Link class="group flex items-center py-3" href="/reports">
                <icon
                    icon="printer"
                    class="mr-2 w-4 h-4"
                    :class="
                        isUrl('reports')
                            ? 'fill-white'
                            : 'fill-indigo-400 group-hover:fill-white'
                    "
                />
                <div
                    :class="
                        isUrl('reports')
                            ? 'text-white'
                            : 'text-indigo-300 group-hover:text-white'
                    "
                >
                    Reports
                </div>
            </Link>
        </div>
    </div>
</template>

<script setup>
// Helpers
import { Inertia } from "@inertiajs/inertia";

// Components
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Shared/Icon";

const isUrl = (...urls) => {
    let currentUrl = Inertia.page.url.substring(1);
    if (urls[0] === "") {
        return currentUrl === "";
    }
    return urls.filter((url) => currentUrl.startsWith(url)).length;
};
</script>
