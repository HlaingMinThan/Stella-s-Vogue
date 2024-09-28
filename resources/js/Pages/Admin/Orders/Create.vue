<template>
    <div>
        <h1 class="text-xl font-bold">Create Order</h1>
        <OrderForm :initialForm="initialForm" :isEditMode="false" :collections="collections" :payments="payments" :deliveries="deliveries"/>
    </div>
</template>
  
<script>
import OrderForm from './components/OrderForm.vue';
  
export default {
    props : {
        collections : Array,
        deliveries : Array,
        payments : Array,
    },
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
  