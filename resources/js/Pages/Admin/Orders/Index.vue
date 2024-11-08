<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2" v-if="!date && !selected_collection">
            <!-- Breadcrumb -->
            <Breadcrumb :icon="'fa-boxes'" :label="'Orders'" :href="route('admin.orders.index')">
                <BreadcrumbItem :label="'Lists'" />
            </Breadcrumb>

            <!-- Create Button -->
            <div class="min-w-[270px] md:flex items-center justify-end">
                <InertiaLinkButton :href="route('admin.orders.create')" class="w-full md:w-auto bg-primary text-white">
                    <i class="fa-solid fa-file-circle-plus mr-1"></i>
                    Create
                </InertiaLinkButton>
            </div>
        </div>
        <!-- Table Start -->
        <div class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3">
            <h1 v-if="date" class="text-center text-2xl font-semibold my-3">Orders for {{ date }}</h1>
            <div class="my-3 flex flex-col xl:flex-row space-y-5 sm:space-y-0 xl:items-center justify-between" v-if="!date">
                <div class="relative">
                    <SelectBox
                        class="w-[380px]"
                        v-model="selected_collection"
                        placeholder="Choose collection"
                        :options="collections"
                        :reduce="collection => collection.id"
                        :get-option-label="(option) => `${option.name}`"
                    />
                </div>
                <div class="flex items-center xl:flex-nowrap flex-wrap  gap-3">
                    <input
                        type="date"
                        id="order_date"
                        :value="date"
                        @change="handleDateChange"
                        class="mt-1 block md:w-min w-full  py-4 shadow-sm sm:text-sm border-gray-300 rounded-md"
                    />
                            <DashboardTableDataSearchBox
                                placeholder="Search by customer name,phone,address and color"
                                :href="route('admin.orders.index')"
                            />
                </div>
        </div>

            <TableContainer :data-count="orders?.data?.length" :paginate-links="orders.links">
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="orders.data">
                            <template #table-header>
                                <TableHeaderCell label="Name" class="min-w-[180px]"/>
                                <TableHeaderCell label="Amount" class="min-w-[300px]" />
                                <TableHeaderCell label="Deli Amount" class="min-w-[300px]" />
                                <TableHeaderCell label="Phone" class="min-w-[150px]" />
                                <TableHeaderCell label="Address" class="min-w-[180px]"/>
                                <TableHeaderCell label="Payment" class="min-w-[150px]" />
                                <!-- preview -->
                                <TableHeaderCell label="screenshot" class="min-w-[150px]" />
                                <TableHeaderCell label="Delivery" class="min-w-[150px]" />
                                <TableHeaderCell label="Date" class="min-w-[150px]" />
                                <TableHeaderCell label="Actions"  />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell>{{ item.name }}</TableDataCell>
                                <TableDataCell>{{ formatMoney(item.amount) }}MMK</TableDataCell>
                                <TableDataCell>{{ item.deli_amount? formatMoney(item.deli_amount) : 0 }}MMK</TableDataCell>
                                <TableDataCell>{{ item.phone }}</TableDataCell>
                                <TableDataCell>{{ item.address }}</TableDataCell>
                                <TableDataCell>{{ item.payment }}</TableDataCell>
                                <TableDataCell>
                                    <img v-if="item.screenshot" :src="item.screenshot" class="w-12 h-12" @click="screenshot = item.screenshot;open=true">
                                    <p v-else>-</p>
                                </TableDataCell>
                                <TableDataCell>{{ item.delivery.name }}</TableDataCell>
                                <TableDataCell class=" min-w-[200px]"><p class="line-clamp-2">{{ item.created_at }}</p></TableDataCell>
                                <TableActionCell v-if="item.viewable">
                                    <InertiaLinkButton
                                        :href="route('admin.orders.details.index', { order: item?.id })"
                                        class="bg-yellow-600 hover:bg-yellow-700 text-white !text-xs !font-semibold"
                                    >
                                        <i class="fa-solid fa-edit"></i>
                                        View
                                    </InertiaLinkButton>
                                    <InertiaLinkButton
                                    v-if="item.editable"
                                        :href="route('admin.orders.edit', { order: item?.id })"
                                        class="bg-blue-600 hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                        <i class="fa-solid fa-edit"></i>
                                        Edit
                                    </InertiaLinkButton>
                                    <NormalButton
                                        v-if="item?.deletable"
                                        type="button"
                                        @click="
                                            destroy(
                                                'Membership',
                                                route('admin.orders.destroy', { order: item?.id })
                                            )
                                        "
                                        class="bg-red-600 hover:bg-red-700 text-white !text-xs !font-semibold"
                                    >
                                        <i class="fa-solid fa-ban"></i>
                                        Delete
                                    </NormalButton>
                                </TableActionCell>
                            </template>
                        </Table>
                        <Modal :open="open"  @closeModal="open=false" :can-close-backdrop="true" >
                            <img :src="screenshot" class="w-full h-[500px]" @click="open = true">
                        </Modal>
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
import Modal from '@/Components/Atoms/Modal.vue';
import InertiaLinkButton from '@/Components/Atoms/InertiaLinkButton.vue';
import DashboardTableDataSearchBox from '@/Components/Common/DashboardTableDataSearchBox.vue';
import TableContainer from '@/Components/Molecules/TableContainer.vue';
import Table from '@/Components/Common/Table.vue';
import TableHeaderCell from '@/Components/Molecules/TableHeaderCell.vue';
import TableDataCell from '@/Components/Molecules/TableDataCell.vue';
import TableActionCell from '@/Components/Molecules/TableActionCell.vue';
import NormalButton from '@/Components/Atoms/NormalButton.vue';
import formatMoney from '@/Helpers/formatMoney';
import SelectBox from '@/Components/Atoms/SelectBox.vue';
import { emitter } from '@/Helpers/emitter';
import { router, usePage } from '@inertiajs/vue3';

export default {
    components: {
        Breadcrumb,
        BreadcrumbItem,
        SelectBox,
        InertiaLinkButton,
        DashboardTableDataSearchBox,
        TableContainer,
        Table,
        TableHeaderCell,
        TableDataCell,
        TableActionCell,
        NormalButton,
        Modal
    },
    props: {
        collection: Object, // This will receive the data directly from the backend
        date: String, // This will receive the data directly from the backend
        orders: Array, // This will receive the data directly from the backend
        collections: Array, // This will receive the data directly from the backend
        old_selected_collection: Number, // This will receive the data directly from the backend
    },
    data(){
        return{
            open: false,
            screenshot:null,
            selected_collection: this.old_selected_collection || null
        };
    },
    watch: {
        selected_collection: function () {
            this.handleCollectionChange(this.selected_collection);
        }
    },
    computed:{
        date(){
            return usePage().props.ziggy?.query?.date;
        }
    },
    methods: {
        formatMoney,
        handleCollectionChange(id) {
            this.$inertia.get(route('admin.orders.index', { collection_id: id }),{},{
                preserveState: true,
            });
        },
        handleDateChange(e){
            console.log(e)
            let search =usePage().props.ziggy.query?.search
            const formattedDate = new Date(e.target.value).toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: '2-digit'
                                }).replace(/\//g, '-'); 
            router.get(route('admin.orders.index',{search,date : formattedDate }))
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
    }
};
</script>

<style scoped>
/* Add your CSS styles here */
</style>
