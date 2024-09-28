<script setup>
import {computed} from 'vue';
// import InertiaLinkButton from '@/Components/Atoms/InertiaLinkButton.vue';
import CheckBadge from '@/Components/Icons/CheckBadge.vue';
import formatMoney from '@/Helpers/formatMoney';

const props=defineProps({
    transaction:{
        type:Object,
        default:null
    },
    transactions:{
        type:Array,
        default: () => []
    }});

const isMultiple = computed(() => Array.isArray(props.transactions) && props.transactions.length > 0);
const transactionsList = computed(() => isMultiple.value ? props.transactions : [props.transaction]);

const totalAmount = computed(() => {
    if (isMultiple.value && props.transactions.length > 1) {
        return parseFloat(transactionsList.value[0]?.charged_amount)+parseFloat(transactionsList.value[1]?.charged_amount);
    }
    return parseFloat(transactionsList.value[0]?.charged_amount) || 0;
});
</script>


<template>
    <div data-cy="payment-invoice" class="bg-white border border-gray-200 shadow-sm rounded-md p-5 max-w-[450px]">
        <div class="flex items-center justify-center mb-3">
            <CheckBadge/>
        </div>

        <div class="text-center space-y-3 mb-12">
            <h1 class="font-bold text-xl text-darkGray">Thanks for your subscription.</h1>
            <p class="text-sm text-gray-700">We received your payment and here is your invoice for your subscription.</p>
        </div>

        <div
            class="flex items-center font-medium justify-between text-sm text-darkGray mb-10 capitalize px-3"
        >
            <div class="text-gray-700 space-y-1 text-left">
                <p class="text-xs">User:</p>
                <p class="text-sm">
                    <span class="font-semibold text-darkGray mr-1">{{ transactionsList[0]?.user?.name }}</span>
                    <span class="lowercase">( {{ transactionsList[0]?.user?.email }} )</span>
                </p>
            </div>
            <div class="text-gray-700 space-y-1 text-right">
                <p class="text-xs">Payment method:</p>
                <p class="text-sm text-darkGray capitalize">
                    {{transactionsList[0]?.pm_type}}
                </p>
            </div>
        </div>

        <div
            class="flex items-center font-medium justify-between text-sm text-darkGray mb-10 capitalize px-3"
        >
            <div class="text-gray-700 space-y-1 text-left">
                <p class="text-xs">Date of Payment:</p>
                <p class="text-sm text-darkGray">
                    {{transactionsList[0]?.subscribed_date}}
                </p>
            </div>
            <div class="text-gray-700 space-y-1 text-right">
                <p class="text-xs">Currency:</p>
                <p class="text-sm text-darkGray">
                    Thai Baht
                </p>
            </div>
        </div>

        <div class="bg-gray-100 rounded-sm w-full p-3 flex items-center justify-between font-bold text-darkGray text-sm mb-5">
            <p>Subscription</p>
            <p>Amount</p>
        </div>

        <div class="flex items-center font-medium justify-between text-sm text-darkGray px-3 capitalize mb-3">
            <p>{{ transactionsList[0]?.plan?.name+' '+transactionsList[0].price?.billing_period }}</p>
            <p>฿ {{ formatMoney(transactionsList[0]?.charged_amount) }}</p>
        </div>

        <div v-if="transactionsList.length > 1" class="flex items-center font-medium justify-between text-sm text-darkGray px-3 capitalize">
            <p>{{ transactionsList[1]?.plan?.name+' '+transactionsList[1].price?.billing_period }}</p>
            <p>฿ {{ formatMoney(transactionsList[1]?.charged_amount) }}</p>
        </div>

        <hr class="my-5"/>

        <div class="space-y-3">
            <div class="flex items-center font-medium justify-between text-sm text-darkGray px-3">
                <p>Subtotal:</p>
                <p>฿ {{ formatMoney(totalAmount) }}</p>
            </div>
            <!-- <div class="flex items-center font-medium justify-between text-sm text-darkGray px-3">
                <p>Discount:</p>
                <p>0 %</p>
            </div> -->
            <div class="flex items-center font-medium justify-between text-sm text-darkGray px-3">
                <p>Total:</p>
                <p>฿ {{ formatMoney(totalAmount) }}</p>
            </div>

        </div>

        <!-- <div v-if="$page.url.startsWith('/auth/confirmation')" class="flex items-center justify-center !mt-6">
            <InertiaLinkButton :href="route('settings.invoice.downloadable',{user:$page.props.auth?.user?.username,transaction:transaction?.id})" class="bg-primary text-white shadow-none !py-2 !text-xs">
                <i class="fa-solid fa-download mr-1"></i>
                Download Invoice
            </InertiaLinkButton>
        </div> -->
    </div>
</template>

