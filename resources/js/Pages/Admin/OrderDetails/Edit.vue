<template>
    <order-detail-form :isEditMode="true" :initialForm="orderDetail" :collection="collection"/>
</template>

<script>
import OrderDetailForm from './OrderDetailForm.vue'
export default {
    props : {
        orderDetail : Object,
        collection : Object
    },
    components : {
        OrderDetailForm
    }
}
</script>

<style>

</style>