<template>
    <div class="lg:h-screen h-auto gap-x-10 flex lg:flex-row flex-col items-center">
        <div class="basis-[60%] xl:pl-16 px-6">
            <h1
                class="xl:text-6xl md:text-5xl text-3xl lg:mt-0 mt-10 leading-[1.3] font-bold"
            >
                {{ title }}
            </h1>
            <p class="md:text-lg text-md py-10">
                {{ description }}
            </p>

            <Button v-if="buttonText" :text="buttonText" class="mb-10" :href="goToRoute" />
        </div>
        <div class="basis-[40%] w-full h-96 md:h-full">
            <img class="w-full h-full object-cover" :src="image" alt="" />
        </div>
    </div>
</template>
<script>
import Button from '../Atoms/Button.vue';
export default {
    components: { Button },
    props: {
        title: {
            type: String,
        },
        description: {
            type: String,
        },
        buttonText: {
            type: String,
        },
        image: {
            type: String,
        },
    },
    data(){
        return{
            user: this.$page.props.auth?.user,
            goToRoute:''
        };
    },
    methods: {
        determineRedirectRoute() {
            if (this.$page.url.startsWith('/personal-plan')) {
                return route('personal-plan.converage-and-pricing')+'#plans';
            }
            if (this.$page.url.startsWith('/business-plan')) {
                return route('business-plan.converage-and-pricing')+'#plans';
            }
            if (this.$page.url.startsWith('/get-started')) {
                return route('get-started')+'#plans';
            }
            if (this.user&&this.$page.url.startsWith('/get-started')) {
                return route('settings.subscriptions');
            }
            if (this.user && !this.user.current_plans?.length) {
                return route('auth.payment');
            }
            if (this.user && this.user.current_plans?.length > 0) {
                return route('settings.subscriptions');
            }
            if (this.user && this.hasPaymentIssues) {
                return route('settings.payment-methods');
            }
            return this.$page.url;
        },
        scrollToPlans() {
            if (window.location.hash === '#plans') {
                const plansElement = document.getElementById('plans');
                if (plansElement) {
                    const offset = 100;
                    const elementPosition = plansElement.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({ top: elementPosition, behavior: 'smooth' });
                    // history.replaceState(null, null, window.location.pathname);
                }
            }
        }
    },
    mounted() {
        this.goToRoute = this.determineRedirectRoute();
        this.scrollToPlans();
    },
};
</script>
<style></style>
