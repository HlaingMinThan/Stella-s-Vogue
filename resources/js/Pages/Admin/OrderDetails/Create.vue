<template>
    <order-detail-form :isEditMode="false" :collection="collection" :collection_details="collection_details" />
</template>

<script>
import OrderDetailForm from './OrderDetailForm.vue'
export default {
    props : {
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