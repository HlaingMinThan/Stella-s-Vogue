<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold ">Remaining Stocks({{collection.name}})</h1>
        
    </div>
        <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-3">
            <div class="flex mb-2 flex-col gap-2  text-white rounded-lg  items-center " v-for="collectionDetail in collection_details">
                <div class="bg-white w-full shadow-lg rounded-lg p-5">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-xl font-bold text-gray-800 capitalize">Color: {{collectionDetail.color}}</div>
                    <div class="text-md text-gray-600 capitalize">Size: {{ collectionDetail.size }}</div>
                </div>
                <div class="flex flex-col items-center">
                <p class="text-bold "
                :class="[collectionDetail.in_stock == 0 ? 'text-red-500' : 'text-green-500']"
                >{{ collectionDetail.in_stock }}</p>
                <div class=" font-semibold"
                :class="[collectionDetail.in_stock == 0 ? 'text-red-500' : 'text-green-500']"
                >
                    {{ collectionDetail.in_stock == 0 ? 'Out of Stock' : 'In Stock' }}
                </div>
            </div>
            </div>
        </div>
            </div>
        </div>
        <div  class="min-w-[270px] md:flex gap-3 items-center justify-end">
            <InertiaLinkButton v-if="user.role.slug == 'admin' || user.role.slug == 'stock'" :href="route('admin.refill.update',{ collection:collection.id })" class="w-full md:w-[150px]  bg-primary text-white">
                <i class="fa-solid fa-file-circle-plus mr-1"></i>
                Refill
            </InertiaLinkButton>
            <InertiaLinkButton v-if="user.role.slug == 'admin' || user.role.slug == 'staff'" :href="route('admin.order_details.create',{ collection:collection.id })" class="w-full md:w-[150px]  bg-primary text-white">
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
                                <TableHeaderCell label="Price Per Product" />
                                <TableHeaderCell label="Pcs" />
                                <TableHeaderCell label="Total Price" />
                                <TableHeaderCell v-if="user.role.slug !== 'staff'" label="Actions" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell>{{ item.id }}</TableDataCell>
                                <TableDataCell>{{ item.order.name }}</TableDataCell>
                                <TableDataCell>{{ item.collection_detail.color }}/ {{ item.collection_detail.size }}</TableDataCell>
                                <TableDataCell>{{ item.amount / item.pcs }} MMK</TableDataCell>
                                <TableDataCell>{{ item.pcs ?? 0 }}</TableDataCell>
                                <TableDataCell>{{ item.amount  }} MMK</TableDataCell>
                                <TableActionCell v-if="user.role.slug !== 'staff'">
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
import { Link, usePage } from '@inertiajs/vue3';

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
    computed:{
        user(){
            return usePage().props.auth.user
        }
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
