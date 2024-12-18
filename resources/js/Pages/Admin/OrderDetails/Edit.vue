<template>
    <order-detail-form :collection_details="collection_details" :isEditMode="true" :initialForm="orderDetail" :collection="collection"/>
</template>

<script>
import OrderDetailForm from './OrderDetailForm.vue'
export default {
    props : {
        orderDetail : Object,
        collection : Object,
        collection_details : Object
    },
    components : {
        OrderDetailForm
    }
}
</script>

<style>

</style>