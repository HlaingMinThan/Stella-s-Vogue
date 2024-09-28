<template>
    <!-- md:bottom-20 md:right-4 -->
    <div>
        <div class="fixed bottom-[54%] translate-y-[54%] right-2 flex flex-col items-end space-y-2 z-50">
            <div
                v-if="expanded"
                class="space-y-4 transition-all duration-300 bg-gray-200 p-3 rounded-full shadow-lg"
            >
                <a href="#" target="_blank" class="block transform hover:scale-110 transition-transform">
                    <i class="fa-brands fa-facebook-messenger text-blue-700 text-3xl"></i>
                </a>
                <a href="#" target="_blank" class="block transform hover:scale-110 transition-transform">
                    <i class="fa-brands fa-line text-green-500 text-3xl"></i>
                </a>
                <a href="#" target="_blank" class="block transform hover:scale-110 transition-transform">
                    <i class="fa-brands fa-whatsapp text-green-400 text-3xl"></i>
                </a>
            </div>

        </div>
        <button
            @click="toggleExpanded"
            class=" text-white p-3 fixed bottom-[37.5%] translate-y-[37.5%] right-2.5 rounded-full focus:outline-none transition-transform duration-300 shadow-lg transform hover:scale-110 bg-primary"
            :class="{ 'rotate-180': expanded }"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="w-6 h-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19 9l-7 7-7-7"
                />
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            expanded: true,
        };
    },
    methods: {
        toggleExpanded() {
            this.expanded = !this.expanded;
        },
    },
};
</script>

<style scoped>
</style>
