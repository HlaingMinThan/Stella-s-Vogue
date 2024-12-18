<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2" v-if="!date">
            <!-- Breadcrumb -->
            <Breadcrumb :icon="'fa-boxes'" :label="'Collections'" :href="route('admin.collections.index')">
                <BreadcrumbItem :label="'Lists'" />
            </Breadcrumb>

            <!-- Create Button -->
            <div class="min-w-[270px] md:flex items-center justify-end">
                <InertiaLinkButton :href="route('admin.collections.create')" class="w-full md:w-auto bg-primary text-white">
                    <i class="fa-solid fa-file-circle-plus mr-1"></i>
                    Create
                </InertiaLinkButton>
            </div>
        </div>

        <!-- Table Start -->
        <div class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3">
            <div class="my-3 flex sm:flex-row space-y-5 sm:space-y-0 items-center justify-end">
                <DashboardTableDataSearchBox
                    placeholder="Search by collection name"
                    :href="route('admin.collections.index')"
                />
            </div>

            <TableContainer :data-count="collections?.data?.length" :paginate-links="collections.links">
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="collections.data">
                            <template #table-header>
                                <TableHeaderCell label="ID" />
                                <TableHeaderCell label="Name" />
                                <!-- <TableHeaderCell label="Fabric" class="min-w-[150px]"/>
                                <TableHeaderCell label="Under" class="min-w-[150px]" />
                                <TableHeaderCell label="Sample Pattern" class="min-w-[180px]"/>
                                <TableHeaderCell label="Sew Fees" class="min-w-[150px]" />
                                <TableHeaderCell label="Model Fees" class="min-w-[150px]" />
                                <TableHeaderCell label="Model Deli" class="min-w-[150px]" />
                                <TableHeaderCell label="Boosting" class="min-w-[150px]" />
                                <TableHeaderCell label="Ph Bill" class="min-w-[150px]" />
                                <TableHeaderCell label="Packing" class="min-w-[150px]" />
                                <TableHeaderCell label="Extra" class="min-w-[150px]" />
                                <TableHeaderCell label="Taxi" class="min-w-[150px]" />
                                <TableHeaderCell label="GA + Vlog" class="min-w-[150px]" />
                                <TableHeaderCell label="Sum" class="min-w-[180px]" /> -->
                                <TableHeaderCell label="Stock" class="min-w-[150px]" />
                                <TableHeaderCell label="Actions" class="min-w-[150px]" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell>{{ item.id }}</TableDataCell>
                                <TableDataCell>{{ item.name }}</TableDataCell>
                                <!-- <TableDataCell><span class="font-bold">{{ formatMoney(item.fabric) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.under) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.sample_pattern) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.sew_fees) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.model_fees) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.model_deli_fees) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.boosting) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.phone_bill) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.packing_fees) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.extra_charges) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.taxi_charges) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.ga__vlog_charges) }} MMK</span></TableDataCell>
                                <TableDataCell><span class="font-bold">{{ formatMoney(item.sum) }} MMK</span></TableDataCell> -->
                                <TableDataCell><span class="font-bold">{{ item.stock }}</span></TableDataCell>
                                <TableActionCell>
                                    <InertiaLinkButton
                                        :preserve-scroll="false"
                                        :href="route('admin.refill.index', { collection: item?.id })"
                                        class="bg-blue-600 hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                        Refill
                                    </InertiaLinkButton>
                                    <NormalButton
                                        v-if="item.deletable"
                                        type="button"
                                        @click="
                                            destroy(
                                                'Membership',
                                                route('admin.collections.destroy', { collection: item?.id })
                                            )
                                        "
                                        class="bg-red-600 hover:bg-red-700 text-white !text-xs !font-semibold"
                                    >
                                        <i class="fa-solid fa-ban"></i>
                                        Delete
                                    </NormalButton>
                                    <InertiaLinkButton
                                        :href="route('admin.order_details.index', { collection: item?.id })"
                                        class="bg-yellow-600 hover:bg-yellow-700 text-white !text-xs !font-semibold"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                        Orders
                                    </InertiaLinkButton>
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
        collections: Array,Link // This will receive the data directly from the backend
    },
    methods: {
        formatMoney,
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
};
</script>

<style scoped>
/* Add your CSS styles here */
</style>
