<template>
    <div>
        <input ref="datepicker" v-model="formattedDate" @input="onInput">
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.css';

// Define component props
const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    },
    format: {
        type: String,
        default: 'd-m-Y' // Default date format
    }
});

const emit = defineEmits(['update:modelValue']);

// The current value of the date picker
const formattedDate = ref(props.modelValue);

// Reference to the input element
const datepicker = ref(null);

// Get today's date in the required format
const getTodayDate = () => {
    const today = new Date();
    const day = String(today.getDate()).padStart(2, '0');
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const year = today.getFullYear();
    return `${day}-${month}-${year}`; // Adjust format as needed
};

// Initialize Flatpickr with today's date as maxDate and disable time picker
const initializeFlatpickr = () => {
    flatpickr(datepicker.value, {
        dateFormat: props.format,
        maxDate: getTodayDate(), // Set max date to today's date
        enableTime: false, // Disable the time picker
        onChange: (selectedDates, dateStr) => {
            formattedDate.value = dateStr; // Update local value
            emit('update:modelValue', dateStr); // Emit change to parent
        },
        onOpen: () => {
            const selectedDate = datepicker.value._flatpickr.selectedDates[0];
            if (selectedDate) {
                // Preserve the day of the week
                console.log(`Selected day: ${selectedDate.toLocaleDateString('th-TH', { weekday: 'long' })}`);
            }
        }
    });
};

// Initialize Flatpickr on component mount
onMounted(() => {
    initializeFlatpickr();
});

// Watch for changes to modelValue to update formattedDate
watch(() => props.modelValue, (newValue) => {
    formattedDate.value = newValue; // Update the internal value
});
</script>

  <style scoped>
  /* Add any additional styling here */
  </style>
