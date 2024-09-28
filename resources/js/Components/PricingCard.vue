<template>
    <!-- <pre>
        {{ pricingCard }}
    </pre> -->
    <div data-cy="pricing-card" class="rounded-xl overflow-hidden shadow-card">
        <div class="py-9 px-10">
            <div class="">
                <h1 class="text-3xl font-bold">{{ pricingCard?.title }}</h1>
                <p class="mt-3 text-ellipsis md:overflow-hidden md:h-[130px]" v-if="pricingCard?.description">
                    {{price?.description }}
                </p>
            </div>
            <div class="mt-10">

                <div v-if="price?.discount > 0" class="mb-5">
                    <Badge primary>
                        Save- {{price?.discount}}% off
                    </Badge>
                </div>

                <p>plans starting at</p>
                <div class="text-4xl md:text-5xl font-bold mt-2">
                    <span class="">฿</span>{{ price?.amount }}<span class="text-4xl">/</span><span class="text-3xl">{{ billingPeriodLabel }}</span>
                </div>
            </div>
            <Button
                data-cy="detail-btn"
                class="mt-10 w-full btn"
                text="See Details"
                type="link"
                :href="detailRoute"
            />
            <!-- <Button
                data-cy="subscribe-btn"
                :text="price?.isSubscribed ? 'Subscribed' : 'Get Started'"
                :disabled="price?.isSubscribed ? true : false"
                :class="[price?.isSubscribed ? ' cursor-not-allowed' : '']"
                class="mt-10 w-full btn"
                type="button"
                @click="subscribeHandler"
            /> -->
            <!-- <Button
                data-cy="add-to-cart-btn"
                text="Add To Cart"
                :outline="true"
                v-if="!price?.isSubscribed && (!isLogin || !userCurrentPlans.length)"
                @click="addPricePlanToCard"
                class="mt-2 w-full add-to-cart"
                :class="[
                    price?.isSubscribed ? 'opacity-40 cursor-not-allowed' : 'opacity-100',
                ]"
                type="button"
            /> -->
            <div class="flex flex-col justify-between">
                <div>
                    <p class="mt-7 text-lg font-medium mb-3">Coverage Details:</p>
                    <div class="flex flex-col mt-2 gap-2 pl-4">
                        <div
                            v-for="(service, index) in pricingCard.services"
                            :key="index"
                            class="flex gap-3"
                        >
                            <!-- <svg
                                class="shrink-0"
                                xmlns="http://www.w3.org/2000/svg"
                                width="26"
                                height="26"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    fill="currentColor"
                                    d="M10 15.689L6.712 12.4l.688-.688l2.6 2.6l6.6-6.6l.688.688z"
                                />
                            </svg> -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-primary" >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            <p class="text-sm">
                                {{ service }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <Link :href="detailRoute" class="flex justify-center items-center gap-2 mt-5 text-primary hover:underline">
                <p class="font-semibold">See Details</p>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="currentColor"
                        d="M16.15 13H5q-.425 0-.712-.288T4 12t.288-.712T5 11h11.15L13.3 8.15q-.3-.3-.288-.7t.288-.7q.3-.3.713-.312t.712.287L19.3 11.3q.15.15.213.325t.062.375t-.062.375t-.213.325l-4.575 4.575q-.3.3-.712.288t-.713-.313q-.275-.3-.288-.7t.288-.7z"
                    />
                </svg>
            </Link> -->
        </div>
    </div>
</template>

<script>
import { mapMutations } from 'vuex';
import Button from './Atoms/Button.vue';
import {  router, usePage } from '@inertiajs/vue3';
import { createToaster } from '@meforma/vue-toaster';
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
    },
    computed: {
        price() {
            return  this.pricingCard.prices.find(price => price.billing_period === this.activePeriod);
        },

        isLogin() {
            return usePage().props.auth.user;
        },
        billingPeriodLabel() {
            const periodLabels = {
                monthly: 'mo.',
                semiannually: 'Semi.',
                yearly: 'yr.'
            };
            return periodLabels[this.activePeriod] || 'mo.';
        },
        detailRoute() {
            return this.pricingCard.name === 'Personal'
                ? '/personal-plan/coverage-and-pricing#plans'
                : '/business-plan/coverage-and-pricing#plans';
        },
        userCurrentPlans() {
            return usePage().props.auth.user.current_plans;
        },
    },
    methods: {
        ...mapMutations(['addToCart']),
        addPricePlanToCard() {
            // eslint-disable-next-line no-unused-vars
            const { prices, ...pricingCardDetail } = this.pricingCard;
            this.addToCart({
                ...pricingCardDetail,
                price: this.price,
            });


            // this.$inertia.get(route('auth.account'));
        },
        subscribeHandler() {
            if (
                usePage().props.auth.user &&
        usePage().props.auth.user.current_plans.length
            ) {
                const toaster = createToaster({
                    position: 'bottom-right',
                    useDefaultCss: true,
                    maxToasts: 1,
                });
                toaster.clear();
                toaster['warning']('You can update user plan at your profile page.');
            } else if (
                usePage().props.auth.user &&
        !usePage().props.auth.user.current_plans.length
            ) {
                this.addPricePlanToCard();
                router.get(route('auth.payment'));
            } else {
                this.addPricePlanToCard();
                router.get(route('auth.account'));
            }
        },
    },
};
</script>
<style scoped>
.pricing-card {
  position: relative;
  overflow: hidden;
}

.pricing-card::before,
.pricing-card::after {
  content: "";
  position: absolute;
  top: 0;
  width: 50%;
  height: 100%;
  background-color: #454545;
  z-index: 1;
  transition: transform 0.5s;
}

.pricing-card::before {
  left: 0;
  transform: translateX(-100%);
}

.pricing-card::after {
  right: 0;
  transform: translateX(100%);
}

.pricing-card:hover::before,
.pricing-card:hover::after {
  transform: translateX(0);
}

.pricing-card:hover {
  color: white;
  will-change: color;
}

.btn {
  position: relative;
  overflow: hidden;
  color: #ffffff;
  transition: color 0.5s ease-in-out;
}

.btn::before {
  content: "";
  position: absolute;
  top: 0;
  left: 50%;
  width: 100%;
  height: 100%;
  background-color: #CC8809;
  transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
  transform: translateX(-50%) scaleX(0);
  transform-origin: center;
  z-index: -1;
}

.pricing-card:hover .btn {
  color: white;
}

.pricing-card:hover .btn::before {
  transform: translateX(-50%) scaleX(1);
}
.pricing-card * {
  position: relative;
  z-index: 10;
}

.pricing-card a,
.pricing-card p,
.pricing-card h1 {
  position: relative;
  z-index: 10;
  transition: color 0.5s;
  color: inherit;
}
</style>

