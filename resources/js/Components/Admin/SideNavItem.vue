<script setup>
import { router } from '@inertiajs/vue3';

import { useStore } from 'vuex';

const store = useStore();
const pageChange = (path) => {
    store.commit('toggleSideNav',false);
    router.get(path, {
        preserveScroll: false,
    });
};

defineProps({
    item: Object,
});
</script>

<template>
    <div
        @click="pageChange(item.path)"
        class=" w-full rounded-[4px] transition-all duration-150 mb-3"
        :class="[
            $page.url.startsWith(item.url) ? 'text-primary bg-lightBlue': 'hover:bg-yellow-700',
        ]"
    >
        <button
            :href="item.path"
            :preserve-scroll="false"
            class="relative flex items-center gap-2.5 rounded-sm py-3 px-4 font-semibold text-sm duration-300 ease-in-out"
        >
            <span v-if="item.icon">
                <i :class="['fa-solid', item.icon]"></i>
            </span>

            {{ item.title }}
        </button>
    </div>
</template>
