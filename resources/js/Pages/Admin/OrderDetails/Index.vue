<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold ">Remaining Stocks({{collection.name}})</h1>
        <InertiaLinkButton :href="route('admin.refill.update',{ collection:collection.id })" class="w-full md:w-auto bg-primary text-white">
                <i class="fa-solid fa-file-circle-plus mr-1"></i>
                Refill
            </InertiaLinkButton>
    </div>
        <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-3">
            <div class="flex mb-2 flex-col gap-2 px-5 py-4 text-white rounded-lg bg-primary items-center " v-for="collectionDetail in collection_details">
                <div class="flex items-center w-[80%] justify-between gap-4">
                    <p class="">{{ collectionDetail.color }} / {{ collectionDetail.size }}</p>
                    <p> {{ collectionDetail.in_stock }}</p>
                </div>
                <!-- <div class="flex items-center  w-[80%] gap-4">
                    <p class=" shrink-0 w-[60%] font-bold">Size -</p>
                    <p>{{ collectionDetail.size }}</p>
                </div>
                <div class="flex items-center  w-[80%] gap-4">
                    <p class=" shrink-0 font-bold w-[60%]">In stock -</p>
                    <p>{{ collectionDetail.in_stock }} <span class='text-sm'>items</span></p>
                </div> -->
            </div>
        </div>
        <div  class="min-w-[270px] md:flex items-center justify-end">
            <InertiaLinkButton :href="route('admin.order_details.create',{ collection:collection.id })" class="w-full md:w-auto bg-primary text-white">
                <i class="fa-solid fa-file-circle-plus mr-1"></i>
                Create
            </InertiaLinkButton>
        </div>

        

        <!-- Table Start -->
        <div class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3">
            <div class="my-3 flex sm:flex-row space-y-5 sm:space-y-0 items-center justify-end">
                <DashboardTableDataSearchBox
                    placeholder="Search by Customer name"
                    :href="route('admin.order_details.index', { collection: collection.id })"
                />
            </div>

            <TableContainer :data-count="order_details?.data?.length" :paginate-links="order_details.links">
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="order_details.data">
                            <template #table-header>
                                <TableHeaderCell label="ID" />
                                <TableHeaderCell label="Name" />
                                <TableHeaderCell label="Color" />
                                <TableHeaderCell label="Price Per roduct" />
                                <TableHeaderCell label="Pcs" />
                                <TableHeaderCell label="Total Price" />
                                <TableHeaderCell label="Actions" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell>{{ item.id }}</TableDataCell>
                                <TableDataCell>{{ item.order.name }}</TableDataCell>
                                <TableDataCell>{{ item.collection_detail.color }}/ {{ item.collection_detail.size }}</TableDataCell>
                                <TableDataCell>{{ item.amount }}</TableDataCell>
                                <TableDataCell>{{ item.pcs ?? 0 }}</TableDataCell>
                                <TableDataCell>{{ item.amount * item.pcs }}</TableDataCell>
                                <TableActionCell>
                                    <InertiaLinkButton
                                        :preserve-scroll="false"
                                        :href="route('admin.order_details.edit', { orderDetail: item?.id })"
                                        class="bg-blue-600 hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                        Edit
                                    </InertiaLinkButton>
                                    <Button
                                        type="button"
                                        @click="deleteOrderDetail(item?.id)"
                                        class="bg-red-600 hover:bg-red-700 text-white !text-xs !font-semibold px-3 py-3 rounded-lg"
                                    >
                                        Delete
                                    </Button>
                                </TableActionCell>
                            </template>
                        </Table>
                    </div>
                </template>
            </TableContainer>
        </div>
    <!-- Table End -->
    </div>
</template>

<script>
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
import InertiaLinkButton from '@/Components/Atoms/InertiaLinkButton.vue';
import DashboardTableDataSearchBox from '@/Components/Common/DashboardTableDataSearchBox.vue';
import TableContainer from '@/Components/Molecules/TableContainer.vue';
import Table from '@/Components/Common/Table.vue';
import TableHeaderCell from '@/Components/Molecules/TableHeaderCell.vue';
import TableDataCell from '@/Components/Molecules/TableDataCell.vue';
import TableActionCell from '@/Components/Molecules/TableActionCell.vue';
import NormalButton from '@/Components/Atoms/NormalButton.vue';
import formatMoney from '@/Helpers/formatMoney';
import { emitter } from '@/Helpers/emitter';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Breadcrumb,
        BreadcrumbItem,
        InertiaLinkButton,
        DashboardTableDataSearchBox,
        TableContainer,
        Table,
        TableHeaderCell,
        TableDataCell,
        TableActionCell,
        NormalButton,
    },
    props: {
        collection: Object,
        order_details: Array,Link, // This will receive the data directly from the backend
        collection_details : Object
    },
    methods: {
        formatMoney,
        deleteOrderDetail(id) {
            this.$inertia.delete(route('admin.order_details.destroy', { orderDetail: id }));
        },
        async destroy(model, url, confirmationOptions = null){
            emitter.emit('open-confirmation-dialog', {
                title: 'Are you sure you want to delete this ' + model + '?',
                body: 'your data will be permanently deleted',
                confirmLabel: 'Confirm',
                cancelLabel: 'Cancel',
                confirmBtnClass:'!bg-red-600',
                svgIcon: 'warning',
                onConfirm: () => {
                    this.$inertia.delete(url, {
                        preserveScroll: true,
                        onSuccess: () => {
                            emitter.emit('close-confirmation-dialog');
                            toast.success(model === 'Membership' ? 'Membership inactivated successfully.':`${model} deleted successfully.`);
                        },
                    });
                },
            });
        }
    },
    mounted(){
        console.log(this.collection_details)
    }
};
</script>

<style scoped>
/* Add your CSS styles here */
</style>
