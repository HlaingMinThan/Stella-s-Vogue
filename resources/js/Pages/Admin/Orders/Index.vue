<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb :icon="'fa-boxes'" :label="'Orders'" :href="route('admin.orders.index')">
                <BreadcrumbItem :label="'Lists'" />
            </Breadcrumb>

            <!-- Create Button -->
            <div class="min-w-[270px] flex items-center justify-end">
                <InertiaLinkButton :href="route('admin.orders.create')">
                    <i class="fa-solid fa-file-circle-plus mr-1"></i>
                    Create
                </InertiaLinkButton>
            </div>
        </div>

        <!-- Table Start -->
        <div class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3">
            <div class="my-3 flex sm:flex-row space-y-5 sm:space-y-0 items-center justify-between">
                <div class="relative">
                    <SelectBox
                        class="w-[300px]"
                        v-model="selected_collection"
                        placeholder="Choose collection"
                        :options="collections"
                        :reduce="collection => collection.id"
                        :get-option-label="(option) => `${option.name}`"
                    />
                </div>
                <DashboardTableDataSearchBox
                    placeholder="Search by customer name,phone,address and color"
                    :href="route('admin.orders.index')"
                />
            </div>

            <TableContainer :data-count="orders?.data?.length" :paginate-links="orders.links">
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="orders.data">
                            <template #table-header>
                                <TableHeaderCell label="ID" />
                                <TableHeaderCell label="Name" class="min-w-[180px]"/>
                                <TableHeaderCell label="Collection Name" class="min-w-[300px]" />
                                <TableHeaderCell label="Amount" class="min-w-[300px]" />
                                <TableHeaderCell label="Phone" class="min-w-[150px]" />
                                <TableHeaderCell label="Address" class="min-w-[180px]"/>
                                <TableHeaderCell label="Payment" class="min-w-[150px]" />
                                <!-- preview -->
                                <TableHeaderCell label="screenshot" class="min-w-[150px]" />
                                <TableHeaderCell label="Delivery" class="min-w-[150px]" />
                                <TableHeaderCell label="notes" class="min-w-[150px]" />
                                <TableHeaderCell label="Actions"  />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell>{{ item.id }}</TableDataCell>
                                <TableDataCell>{{ item.name }}</TableDataCell>
                                <TableDataCell>{{ item.collection.name }} ({{ item.color }})</TableDataCell>
                                <TableDataCell>{{ formatMoney(item.amount) }}MMK</TableDataCell>
                                <TableDataCell>{{ item.phone }}</TableDataCell>
                                <TableDataCell>{{ item.address }}</TableDataCell>
                                <TableDataCell>{{ item.payment }}</TableDataCell>
                                <TableDataCell>{{ item.screenshot }}</TableDataCell>
                                <TableDataCell>{{ item.delivery.name }}</TableDataCell>
                                <TableDataCell class=" min-w-[200px]"><p class="line-clamp-2">{{ item.notes }}</p></TableDataCell>
                                <TableActionCell>
                                    <InertiaLinkButton
                                        :href="route('admin.orders.edit', { order: item?.id })"
                                        class="bg-blue-600 hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                        <i class="fa-solid fa-edit"></i>
                                        Edit
                                    </InertiaLinkButton>
                                    <NormalButton
                                        v-if="!item?.deleted_at"
                                        type="button"
                                        @click="
                                            destroy(
                                                'Membership',
                                                route('admin.orders.destroy', { collection: item?.id })
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
import SelectBox from '@/Components/Atoms/SelectBox.vue';
import { emitter } from '@/Helpers/emitter';

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
    },
    props: {
        orders: Array, // This will receive the data directly from the backend
        collections: Array, // This will receive the data directly from the backend
        old_selected_collection: Number, // This will receive the data directly from the backend
    },
    data(){
        return{
            selected_collection: this.old_selected_collection || null
        };
    },
    watch: {
        selected_collection: function () {
            this.handleCollectionChange(this.selected_collection);
        }
    },
    methods: {
        formatMoney,
        handleCollectionChange(id) {
            this.$inertia.get(route('admin.orders.index', { collection_id: id }),{},{
                preserveState: true,
            });
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
