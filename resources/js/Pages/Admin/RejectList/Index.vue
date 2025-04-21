<script setup>
import { format } from 'date-fns'
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue'
import TableContainer from '@/Components/Molecules/TableContainer.vue'
import Table from '@/Components/Common/Table.vue'
import TableHeaderCell from '@/Components/Molecules/TableHeaderCell.vue'
import TableDataCell from '@/Components/Molecules/TableDataCell.vue'
import DashboardTableDataSearchBox from '@/Components/Common/DashboardTableDataSearchBox.vue'
import Datepicker from '@/Components/Atoms/Datepicker.vue'
import Pagination from '@/Components/Common/Pagination.vue'
import InertiaLinkButton from '@/Components/Atoms/InertiaLinkButton.vue'
import NormalButton from '@/Components/Atoms/NormalButton.vue'
import TableActionCell from '@/Components/Molecules/TableActionCell.vue'
import { emitter } from '@/Helpers/emitter';
</script>

<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <Breadcrumb :icon="'fa-rotate-left'" :label="'Returns'" :href="route('admin.return_list.index')">
                <BreadcrumbItem :label="'Lists'" />
            </Breadcrumb>

            <!-- Add Create Button -->
            <div class="min-w-[270px] md:flex items-center justify-end">
                <InertiaLinkButton :href="route('admin.reject_list.create')" class="w-full md:w-auto bg-primary text-white">
                    <i class="fa-solid fa-file-circle-plus mr-1"></i>
                    Create
                </InertiaLinkButton>
            </div>
        </div>

        <!-- Table Start -->
        <div class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 md:px-5 py-3">
            <div class="my-3 flex flex-col xl:flex-row space-y-5 sm:space-y-0 xl:items-center justify-between">
                <div class="flex items-center xl:flex-nowrap flex-wrap gap-3">
                    <!-- <Datepicker v-model="filterDate" /> -->
                    <DashboardTableDataSearchBox
                        placeholder="customer name or collection"
                        :href="route('admin.return_list.index')"
                    />
                </div>
            </div>

            <TableContainer class="md:block hidden" :data-count="rejects?.data?.length" :paginate-links="rejects?.links">
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="rejects?.data">
                            <template #table-header>
                                <TableHeaderCell label="Date" class="min-w-[150px]" />
                                <TableHeaderCell label="Customer Name" class="min-w-[180px]"/>
                                <TableHeaderCell label="Collection" class="min-w-[180px]" />
                                <TableHeaderCell label="Pieces" class="min-w-[180px]" />
                                <TableHeaderCell label="Error Reason" class="min-w-[250px]"/>
                                <TableHeaderCell label="Actions" class="min-w-[150px]" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell>{{ format(new Date(item.date), 'dd-MM-yy') }}</TableDataCell>
                                <TableDataCell>{{ item.customer_name }}</TableDataCell>
                                <TableDataCell>{{ item.collection ?  item.collection.name : '-' }} ({{ item.color }})</TableDataCell>
                                <TableDataCell>{{ item.pieces }}</TableDataCell>
                                <TableDataCell ><p class="line-clamp-1">{{ item.error_reason }}</p></TableDataCell>
                                <TableActionCell>
                                    <InertiaLinkButton
                                        :href="route('admin.reject_list.edit', { reject_list: item.id })"
                                        class="bg-blue-600 hover:bg-blue-700 text-white !text-xs !font-semibold"
                                    >
                                        <i class="fa-solid fa-edit"></i>
                                        Edit
                                    </InertiaLinkButton>
                                    <NormalButton
                                        type="button"
                                        @click=" destroy(
                                                'Reject',
                                                route('admin.reject_list.destroy', { reject_list: item?.id })
                                            )"
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

            <!-- Mobile View -->
            <div class="flex md:hidden flex-col gap-3">
                <div :key="item.id" v-for="item in returns?.data" 
                    class="w-full flex flex-col gap-2 bg-white border-[1px] py-6 px-5 rounded-lg shadow-sm shadow-gray-200">
                    <div>
                        <h1 class="font-semibold">Date</h1>
                        <p>{{ format(new Date(item.created_at), 'dd-MM-yy') }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Customer Name</h1>
                        <p>{{ item.customer_name }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Collection</h1>
                        <p>{{ item.collection_name }} ({{ item.color }})</p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Pieces</h1>
                        <p>{{ item.pieces }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Note</h1>
                        <p>{{ item.note }}</p>
                    </div>
                </div>
            </div>

            <div v-if="returns?.links?.length && returns?.data?.length > 0"
                class="flex md:hidden items-center justify-center py-5">
                <Pagination :links="returns?.links" />
            </div>
        </div>
    </div>
</template>

<script>
import { usePage } from '@inertiajs/vue3'

export default {
    props: {
        rejects: Object,
    },
    data() {
        return {
            filterDate: usePage().props.ziggy?.query?.date
        }
    },
    watch: {
        filterDate(value) {
            this.handleDateChange(value)
        }
    },
    methods: {
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
        },
        handleDateChange(value) {
            let search = usePage().props.ziggy.query?.search
            const formattedDate = new Date(value).toLocaleDateString('en-GB', {
                day: '2-digit',
                month: '2-digit',
                year: '2-digit'
            }).replace(/\//g, '-')
            this.$inertia.get(route('admin.reject_list.index', { search, date: formattedDate }))
        }
    }
}
</script>

