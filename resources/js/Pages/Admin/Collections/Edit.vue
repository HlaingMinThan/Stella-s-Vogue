<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex items-center justify-between">
            <Breadcrumb icon="fa-box" label="Collections" :href="route('admin.collections.index')">
                <BreadcrumbItem label="Edit" />
            </Breadcrumb>
        </div>
        <CollectionForm :initialForm="collection" :isEditMode="true" />
    </div>
</template>
  
<script>
import CollectionForm from './components/CollectionForm.vue';
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
  
export default {
    components: {
        CollectionForm,
        Breadcrumb,
        BreadcrumbItem,
    },
    props : {
        collection: Object
    }
};
</script>
  