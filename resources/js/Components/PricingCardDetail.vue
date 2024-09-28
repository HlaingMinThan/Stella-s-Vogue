<script setup>
import formatMoney from '@/Helpers/formatMoney';
</script>

<template>
    <div class="rounded-xl overflow-hidden shadow-card cursor-pointer">
        <div class="py-9 px-10">
            <h1 class="text-3xl font-bold capitalize">{{ pricingCard.billing_period }}</h1>
            <p class="mt-3 text-ellipsis md:overflow-hidden" v-if="pricingCard.description">
                {{ pricingCard.description }}
            </p>


            <div v-if="pricingCard.billing_period=='monthly'" class="md:py-[50px]"></div>

            <div class="mt-10">
                <div v-if="pricingCard?.discount > 0" class="mb-5">
                    <Badge primary>
                        Save- {{formatMoney(pricingCard?.saved_amount)}} Baht
                    </Badge>
                </div>

                <p>plans starting at</p>
                <p class="text-4xl font-bold mt-2">
                    <!-- ${{ price }}<span class="text-4xl">/</span -->
                    ฿{{ pricingCard.amount }}<span class="text-2xl md:text-3xl">/</span
                    ><span class="text-2xl" v-if="pricingCard.billing_period === 'monthly'">mo.</span>
                    <span class="text-2xl" v-if="pricingCard.billing_period === 'quarterly'">Qtr.</span>
                    <span class="text-2xl" v-if="pricingCard.billing_period === 'semiannually'">6months.</span>
                    <span class="text-2xl" v-if="pricingCard.billing_period === 'yearly'">yr.</span>
                    <span class="text-2xl" v-if="pricingCard.billing_period === 'daily'">day.</span>
                </p>
            </div>

            <Button
                v-if="$page.props.auth?.user && $page.props.auth?.user?.current_plans?.length"
                :text="pricingCard.isSubscribed ? 'Subscribed' : 'Get Started'"
                class="mt-10 w-full"
                @click="subscribeHandler"
                type="button"
            />

            <Button
                data-cy="add-to-cart-btn"
                :text="pricingCard.isSubscribed ? 'Subscribed' :'Add To Cart'"
                v-if="!pricingCard?.isSubscribed && (!$page.props.auth?.user || !$page.props.auth?.user.current_plans?.length)"
                @click="addPricePlanToCard"
                class="mt-10 w-full add-to-cart"
                :class="[
                    pricingCard?.isSubscribed ? 'opacity-40 cursor-not-allowed' : 'opacity-100',
                ]"
                type="button"
            />
            <div class="flex flex-col justify-between">
                <div>
                    <p class="mt-7 text-lg mb-3 font-medium">Coverage Details:</p>
                    <div class="flex flex-col mt-2 gap-2 ">
                        <!-- <div
                            v-for="service in pricingCard.services"
                            :key="service.id"
                            class="flex gap-3"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-primary" >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p class="text-sm">
                                {{ service }}
                            </p>
                        </div> -->
                        <div
                            class="flex gap-3"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 w-6 text-primary" >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p class="text-sm">
                                24/7 Emergency Assistance: Call us anytime for urgent legal help.
                            </p>
                        </div>
                        <div
                            class="flex gap-3"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 w-6 text-primary" >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p class="text-sm">
                                Fast Access to Lawyers: Talk to our experienced lawyers quickly, anywhere in Thailand.
                            </p>
                        </div>
                        <div
                            class="flex gap-3"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 w-6 text-primary" >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p class="text-sm">
                                Full Personal Legal Protection: We help with family issues, property problems, visas, and more.
                            </p>
                        </div>
                        <div
                            class="flex gap-3"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 w-6 text-primary" >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p class="text-sm">
                                Peace of Mind: Get legal advice when you need it, so you feel safe and secure.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapMutations } from 'vuex';
import Button from './Atoms/Button.vue';
import { createToaster } from '@meforma/vue-toaster';
import { router, usePage } from '@inertiajs/vue3';
import Badge from '@/Components/Atoms/Badge.vue';

export default {
    components: { Button,Badge },
    props: {
        pricingCard: {
            type: Object,
        },
        activePeriod: {
            type: String,
            default: 'monthly',
        },

        plan : {
            type : Object
        }
    },

    // computed: {
    //     price() {
    //         if (this.activePeriod === "monthly") {
    //             return 1 * this.pricingCard.price;
    //         } else if (this.activePeriod === "quarterly") {
    //             return 3 * this.pricingCard.price;
    //         } else {
    //             return 12 * this.pricingCard.price;
    //         }
    //     },
    // },
    methods: {
        ...mapMutations(['addToCart']),
        addPricePlanToCard() {

            if(usePage().props.auth?.user && usePage().props.auth?.user?.role?.slug!=='user'){
                const role=usePage().props.auth?.user?.role?.name;
                const toaster = createToaster({
                    position: 'bottom-right',
                    useDefaultCss: true,
                    maxToasts: 1,
                });
                toaster.clear();
                toaster['info'](`You are a ${role?.toLowerCase()} and are not allowed to perform this action.`);

                return;
            }
            // eslint-disable-next-line no-unused-vars
            const {prices, ...planDetail}  = this.plan;
            this.addToCart({
                ...planDetail,
                price : this.pricingCard
            });

            if(!usePage().props.auth?.user){
                this.$inertia.get(route('auth.account'));
            }
        },
        subscribeHandler(){
            if(usePage().props.auth?.user && usePage().props.auth?.user?.role?.slug!=='user'){
                const role=usePage().props.auth?.user?.role?.name;
                const toaster = createToaster({
                    position: 'bottom-right',
                    useDefaultCss: true,
                    maxToasts: 1,
                });
                toaster.clear();
                toaster['info'](`You are a ${role?.toLowerCase()} and are not allowed to perform this action.`);
            }
            else if(usePage().props.auth.user && usePage().props.auth.user.current_plans.length){
                router.get(route('settings.subscriptions'));
            }else if(usePage().props.auth.user && !usePage().props.auth.user.current_plans.length){
                this.addPricePlanToCard();
                router.get(route('auth.payment'));
            }else{
                this.addPricePlanToCard();
                router.get(route('auth.account'));
            }
        }
    },
};
</script>
