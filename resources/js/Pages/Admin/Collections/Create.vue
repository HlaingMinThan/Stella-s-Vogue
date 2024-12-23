<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex items-center justify-between">
            <Breadcrumb icon="fa-box" label="Collections" :href="route('admin.collections.index')">
                <BreadcrumbItem label="Create" />
            </Breadcrumb>
        </div>
        <CollectionCreateForm />
    </div>
</template>

<script>
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
import CollectionCreateForm from './components/CollectionCreateForm.vue';

export default {
    components: {
        CollectionCreateForm,
        Breadcrumb,
        BreadcrumbItem,
    },
};
</script>
