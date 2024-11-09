<template>
    <div class="min-h-screen py-3 space-y-8">
        <div
            class="grid grid-cols-1 md:grid-cols-2"
            v-if="!date && !selected_collection"
        >
            <!-- Breadcrumb -->
            <Breadcrumb
                :icon="'fa-boxes'"
                :label="'Orders'"
                :href="route('admin.orders.index')"
            >
                <BreadcrumbItem :label="'Order Details'" />
            </Breadcrumb>

            <!-- Create Order detail Button (Implement soon)-->
            <!-- <div class="min-w-[270px] md:flex items-center justify-end">
                <InertiaLinkButton :href="route('admin.orders.create')" class="w-full md:w-auto bg-primary text-white">
                    <i class="fa-solid fa-file-circle-plus mr-1"></i>
                    Create
                </InertiaLinkButton>
            </div> -->
        </div>

        <div
            class=" bg-gray-100 flex items-center justify-center md:p-6"
        >
            <div class=" w-full bg-white shadow-lg rounded-lg p-6">
                <!-- Order Title -->
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Customer & Order Infos
                </h2>

                <!-- Customer Information Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Customer Name -->
                    <div class="text-lg">
                        <strong class="block text-gray-700"
                            >Customer Name:</strong>
                        <span class="block text-gray-900">{{order.name}}</span>
                    </div>

                    <!-- Address -->
                    <div class="text-[18px]">
                        <strong class="block text-gray-700">Address:</strong>
                        <span class="block text-gray-900"
                            >{{order.address}}</span
                        >
                    </div>

                    <!-- Phone -->
                    <div class="text-[18px]">
                        <strong class="block text-gray-700">Phone:</strong>
                        <span class="block text-gray-900">{{order.phone}}</span>
                    </div>

                    <!-- Payment Type -->
                    <div class="text-[18px]">
                        <strong class="block text-gray-700"
                            >Payment Type:</strong
                        >
                        <span class="block text-gray-900">{{order.payment}}</span>
                    </div>
                </div>

                <!-- Delivery Information Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Delivery Name -->
                    <div class="text-[18px]">
                        <strong class="block text-gray-700"
                            >Delivery Name:</strong
                        >
                        <span class="block text-gray-900"
                            >{{order.delivery.name}}</span
                        >
                    </div>

                    <!-- Delivery Amount -->
                    <div class="text-[18px]">
                        <strong class="block text-gray-700"
                            >Delivery Amount:</strong
                        >
                        <span class="block text-gray-900">{{order.deli_amount}} MMK</span>
                    </div>
                    <div class="text-[18px]">
                        <strong class="block text-gray-700"
                            >Total Amount:</strong
                        >
                        <span class="block text-gray-900">{{order.total}} MMK</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <!-- <div class="mt-6 flex justify-end">
                    <button
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    >
                        Edit Order
                    </button>
                    <button
                        class="ml-2 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                    >
                        Delete Order
                    </button>
                </div> -->
            </div>
        </div>

        <!-- Order Title -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Order Items
        </h2>
        <!-- Table Start -->
        <div
            class="relative border md:block hidden border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3"
        >
            <TableContainer
                :data-count="items?.data?.length"
                :paginate-links="items.links"
            >
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="items.data">
                            <template #table-header>
                                <TableHeaderCell
                                    label="Collection Name"
                                    class="min-w-[180px]"
                                />
                                <TableHeaderCell
                                    label="Color"
                                    class="min-w-[300px]"
                                />
                                <TableHeaderCell
                                    label="Size"
                                    class="min-w-[300px]"
                                />
                                <TableHeaderCell
                                    label="Amount"
                                    class="min-w-[150px]"
                                />
                                <TableHeaderCell
                                    label="Notes"
                                    class="min-w-[150px]"
                                />
                                <TableHeaderCell label="Actions" />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell>{{
                                    item.collection.name
                                }}</TableDataCell>
                                <TableDataCell>{{ item.color }}</TableDataCell>
                                <TableDataCell>{{ item.size }}</TableDataCell>
                                <TableDataCell
                                    >{{
                                        formatMoney(item.amount)
                                    }}MMK</TableDataCell
                                >
                                <TableActionCell class="min-w-[250px]">{{ item?.notes }}</TableActionCell>
                                <TableActionCell >
                                    <NormalButton
                                        type="button"
                                        @click="
                                            destroy(
                                                'OrderDetail',
                                                route('admin.orderdetail.destroy', {
                                                    orderDetail: item?.id,
                                                })
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
        <div class="flex md:hidden flex-col gap-3">
            <div :key="item.id" v-for="item in items?.data" class="w-full flex flex-col gap-2 bg-white border-[1px] py-4 px-2 rounded-lg shadow-sm shadow-gray-200">
                <div class="">
                    <h1 class="font-semibold">Name</h1>
                    <p>{{ item.collection.name }} (size : {{item.size}}, color : {{item.color}})</p>
                </div>
                <div>
                    <h1 class="font-semibold">Amount</h1>
                    <p>{{
                            formatMoney(item.amount)
                        }}MMK
                    </p>
                </div>
                <div class="">
                    <h1 class="font-semibold">Notes</h1>
                    <p>{{ item.notes }}</p>
                </div>
                <div>
                    <h1 class="font-semibold">Actions</h1>
                    <div class="flex gap-2 mt-2">
                        <NormalButton
                            type="button"
                            @click="
                                            destroy(
                                                'OrderDetail',
                                                route('admin.orderdetail.destroy', {
                                                    orderDetail: item?.id,
                                                })
                                            )
                                        "
                            class="bg-red-600 hover:bg-red-700 text-white !text-xs !font-semibold"
                        >
                            <i class="fa-solid fa-ban"></i>
                            Delete
                        </NormalButton>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-if="items.links?.length && items.data.length > 0"
            class="flex items-center justify-center py-5"
        >
            <Pagination :links="items?.links" />
        </div>
        <!-- Table End -->
    </div>
</template>

<script>
import Breadcrumb from "@/Components/Molecules/Breadcrumb.vue";
import BreadcrumbItem from "@/Components/Atoms/BreadcrumbItem.vue";
import Modal from "@/Components/Atoms/Modal.vue";
import InertiaLinkButton from "@/Components/Atoms/InertiaLinkButton.vue";
import DashboardTableDataSearchBox from "@/Components/Common/DashboardTableDataSearchBox.vue";
import TableContainer from "@/Components/Molecules/TableContainer.vue";
import Table from "@/Components/Common/Table.vue";
import TableHeaderCell from "@/Components/Molecules/TableHeaderCell.vue";
import TableDataCell from "@/Components/Molecules/TableDataCell.vue";
import TableActionCell from "@/Components/Molecules/TableActionCell.vue";
import NormalButton from "@/Components/Atoms/NormalButton.vue";
import formatMoney from "@/Helpers/formatMoney";
import SelectBox from "@/Components/Atoms/SelectBox.vue";
import { emitter } from "@/Helpers/emitter";
import Pagination from '@/Components/Common/Pagination.vue';


export default {
    components: {
        Pagination,
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
        Modal,
    },
    props: {
        order: Object, // This will receive the data directly from the backend
        items: Array, // This will receive the data directly from the backend
    },
    data() {
        return {};
    },
    watch: {},
    methods: {
        formatMoney,
        async destroy(model, url, confirmationOptions = null) {
            emitter.emit("open-confirmation-dialog", {
                title: "Are you sure you want to delete this " + model + "?",
                body: "your data will be permanently deleted",
                confirmLabel: "Confirm",
                cancelLabel: "Cancel",
                confirmBtnClass: "!bg-red-600",
                svgIcon: "warning",
                onConfirm: () => {
                    this.$inertia.delete(url, {
                        preserveScroll: true,
                        onSuccess: () => {
                            emitter.emit("close-confirmation-dialog");
                            toast.success(
                                model === "Membership"
                                    ? "Membership inactivated successfully."
                                    : `${model} deleted successfully.`
                            );
                        },
                    });
                },
            });
        },
    },
};
</script>
