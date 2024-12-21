<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex items-center justify-between">
            <Breadcrumb icon="fa-box" label="Inventories" :href="route('admin.inventories.index')">
                <BreadcrumbItem label="Edit" />
            </Breadcrumb>
        </div>
        <InventoryForm :inventory="inventory" :isEditMode="true" />
    </div>
</template>
  
<script>
import InventoryForm from './InventoryForm.vue';
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
  
export default {
    components: {
        InventoryForm,
        Breadcrumb,
        BreadcrumbItem,
    },
    props : {
        inventory: Object,
    }
};
</script>
  