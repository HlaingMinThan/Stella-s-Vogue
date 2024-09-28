<template>
    <div>
        <h1 class="text-xl font-bold">Create Order</h1>
        <OrderForm :initialForm="initialForm" :isEditMode="false" />
    </div>
</template>
  
<script>
import OrderForm from './components/OrderForm.vue';
  
export default {
    components: {
        OrderForm,
    },
    data() {
        return {
            initialForm: {},
        };
    },
};
</script>
  