<script setup>
import { ref } from 'vue';
import {usePage} from '@inertiajs/vue3';
import Dropdown from '@/Components/Molecules/Dropdown.vue';

const props=defineProps({
    type: {
        type: String,
        validator: (value) => {
            return ['users', 'transactions', 'subscriptions'].includes(value);
        }
    }
});

const formats = ['csv', 'xlsx', 'pdf'];
const dropDownOpen = ref(false);

const toggleDropdown = () => {
    dropDownOpen.value = !dropDownOpen.value;
};


const getIconForFormat = (format) => {
    switch (format) {
    case 'csv':
        return '/csv-icon.png';
    case 'xlsx':
        return '/excel-icon.webp';
    case 'pdf':
        return '/pdf-icon.webp';
    default:
        return '/default-icon.png';
    }
};

const downloadFile = async (format) => {
    try {
        const response = await fetch(route('admin.report.export', {
            type:props.type,
            format,
            _query: {
                ...usePage().props.ziggy?.query
            }}));
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const result = await response.json();
        const { filename, filedata, filetype } = result;

        const blob = base64ToBlob(filedata, getMimeType(filetype));
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    } catch (error) {
        console.error('Download error:', error);
    }
};

const base64ToBlob = (base64, mime) => {
    const byteCharacters = atob(base64);
    const byteArrays = [];
    for (let offset = 0; offset < byteCharacters.length; offset += 512) {
        const slice = byteCharacters.slice(offset, offset + 512);
        const byteNumbers = new Array(slice.length);
        for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }
        const byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }
    return new Blob(byteArrays, { type: mime });
};

const getMimeType = (filetype) => {
    switch (filetype) {
    case 'csv': return 'text/csv';
    case 'xlsx': return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    case 'pdf': return 'application/pdf';
    default: return 'application/octet-stream';
    }
};
</script>

<template>
    <Dropdown @open="dropDownOpen = !dropDownOpen">
        <template #dropdown-button>
            <button
                @click="toggleDropdown"
                class="text-sm border px-5 py-3 rounded-md font-semibold flex items-center bg-neutral-700 hover:bg-neutral-600 text-white"
            >
                <i class="fa-solid fa-file-download mr-1.5"></i>
                <span class="ml-1">Export Report</span>

                <svg
                    class="hidden fill-current sm:block ml-2"
                    :class="dropDownOpen && 'rotate-180'"
                    width="12"
                    height="8"
                    viewBox="0 0 12 8"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"
                        fill=""
                    />
                </svg>
            </button>
        </template>

        <template #dropdown-items>
            <div v-for="format in formats" :key="format">
                <!-- :data="{
                    ...usePage().props.ziggy?.query
                }" -->
                <button
                    type="button"
                    @click="downloadFile(format)"
                    class="cursor-pointer block py-2 px-5 text-sm w-full text-left font-semibold text-darkGray hover:bg-gray-100 rounded-md transition-all"
                >
                    <div class="flex items-center space-x-2">
                        <img :src="getIconForFormat(format)" alt="" class="w-5 object-contain">
                        <span>
                            {{ format==='xlsx' ? "Excel" : format.toUpperCase() }}
                        </span>
                    </div>
                </button>
            </div>
        </template>
    </Dropdown>
</template>
