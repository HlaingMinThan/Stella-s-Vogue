<template>
    <div>
        <h1 class="text-xl font-bold">Edit Order</h1>
        <OrderForm :initialForm="order" :isEditMode="true" />
    </div>
</template>
  
<script>
import OrderForm from './components/OrderForm.vue';
  
export default {
    components: {
        OrderForm,
    },
    props: {
        order: Object, // Should be passed as a prop from the parent component
    },
};
</script>
  