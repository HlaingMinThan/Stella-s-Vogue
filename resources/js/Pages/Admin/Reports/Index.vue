<template>
    <div class="min-h-screen py-3 space-y-8">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <!-- Breadcrumb -->
            <Breadcrumb
                :icon="'fa-boxes'"
                :label="'Reports'"
                :href="route('admin.reports.index')"
            >
                <BreadcrumbItem :label="'Lists'" />
            </Breadcrumb>

            <!-- Create Button -->
            <div class="min-w-[270px] flex items-center justify-end">
                <!-- <InertiaLinkButton :href="route('admin.orders.create')">
                    <i class="fa-solid fa-file-circle-plus mr-1"></i>
                    Create
                </InertiaLinkButton> -->
            </div>
        </div>

        <!-- Table Start -->
        <div
            class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 px-5 py-3"
        >
            <div
                class="my-3 flex sm:flex-row space-y-5 sm:space-y-0 items-center justify-between"
            >
                <div class="relative flex w-full space-x-5 justify-end">
                    <div class="w-full">
                        <label
                            for="payment"
                            class="block text-sm font-medium text-gray-700 mb-3"
                            >Payment Option</label
                        >
                        <SelectBox
                            class="w-full bg-white"
                            v-model="form.payment"
                            placeholder="Choose payment"
                            :options="['all',...payments]"
                            :reduce="(payment) => payment"
                            :get-option-label="(option) => `${option}`"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors?.payment"
                        />
                    </div>
                    <div class="w-full">
                        <label
                            for="payment"
                            class="block text-sm font-medium text-gray-700 mb-3"
                            >Deliveries</label
                        >
                        <SelectBox
                            class="w-full bg-white"
                            v-model="form.delivery_id"
                            placeholder="Choose payment"
                            :options="[{id:'all',name:'All'},...deliveries]"
                            :reduce="(delivery) => delivery.id"
                            :get-option-label="(option) => `${option.name}`"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors?.payment"
                        />
                    </div>
                </div>
            </div>
            <div class="w-full my-3">
                <NormalButton
                    class="text-sm bg-red-700 text-white w-full"
                    @click="reset"
                >
                        Reset
                </NormalButton>
            </div>

            <TableContainer
                :data-count="reports?.data?.length"
                :paginate-links="reports.links"
            >
                <template #table>
                    <div class="overflow-x-auto w-full">
                        <Table :items="reports.data">
                            <template #table-header>
                                <TableHeaderCell label="Date" />
                                <TableHeaderCell
                                    label="Total Order Amount"
                                    class="min-w-[120px]"
                                />
                                <TableHeaderCell
                                    label="Total Ways"
                                    class="min-w-[120px]"
                                />
                            </template>

                            <template #table-data="{ item }">
                                <TableDataCell>{{ item.date }}</TableDataCell>
                                <TableDataCell class="font-bold"
                                    >{{
                                        formatMoney(item.total_order_amount)
                                    }}
                                    MMK</TableDataCell
                                >
                                <TableDataCell>{{
                                    item.total_ways
                                }}</TableDataCell>
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
import Breadcrumb from "@/Components/Molecules/Breadcrumb.vue";
import BreadcrumbItem from "@/Components/Atoms/BreadcrumbItem.vue";
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
        selected: Object,
        reports: Array, // This will receive the data directly from the backend
        deliveries: Array, // This will receive the data directly from the backend
        payments: Array, // This will receive the data directly from the backend
    },
    data() {
        return {
            form: this.$inertia.form({
                payment: this.selected.payment || null,
                delivery_id: this.selected.delivery_id || null,
            }),
        };
    },
    watch: {
       "form.payment": function () {
            this.form.get(this.route("admin.reports.index"), {
                preserveState: true,
            });
        },
        "form.delivery_id": function () {
            this.form.get(this.route("admin.reports.index"), {
                preserveState: true,
            });
        },
    },
    methods: {
        formatMoney,
        reset() {
            this.form.payment = "all";
            this.form.delivery_id = "all";
        },
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

<style scoped>
/* Add your CSS styles here */
</style>
