<template>
    <order-detail-form :isEditMode="false" :collection="collection"/>
</template>

<script>
import OrderDetailForm from './OrderDetailForm.vue'
export default {
    props : {
        collection : Object
    },
    components : {
        OrderDetailForm
    }
}
</script>

<style>

</style>