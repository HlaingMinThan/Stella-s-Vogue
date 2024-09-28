<template>
    <Carousel
        ref="carousel"
        :itemsToShow="1"
        :wrapAround="true"
        :autoplay="10000"
        :items-to-scroll="1"
        :loop="true"
        @slide-start="handleSlideChange"
    >
        <Slide v-for="(image, index) in images" :key="index" >
            <div
                :key="currentSlide"
                class="xl:px-16 px-6 w-full h-screen flex flex-col justify-center items-start  lg:bg-center md:bg-center bg-center bg-cover sm:bg-center"
                :style="{ backgroundImage: `url(${image})`}"
            >
                <h3
                    class="md:mt-16 lg:mt-24 mt-60 md:text-4xl text-4xl font-bold xl:w-[50%] md:w-[70%] w-full leading-[1.2] text-primary animate-text-up md:bg-center sm:bg-center"
                    style="text-align: left;"
                >
                    {{ title }}
                </h3>
             
                <h1 class="md:text-6xl mt-5 text-5xl font-bold xl:w-[50%] md:w-[70%] w-full leading-[1.2] text-white animate-text-up text-shadow" style="text-align: left;">{{ description }}</h1>
                <Button :text="buttonText" class="mt-10 animate-button-up" type="link" :href="goToRoute" />
            </div>
        </Slide>
    </Carousel>
</template>

<script>

import { Carousel, Slide } from 'vue3-carousel';
import Button from '../Atoms/Button.vue';
import 'vue3-carousel/dist/carousel.css';

export default {
    components: {
        Carousel,
        Slide,
        Button
    },
    props: {
        title: {
            type: String,
        },
        buttonText: {
            type: String,
        },
        bgImage: {
            type: Array,
        },
        description: {
            type: String,
        }
    },
    data() {
        return {
            user: this.$page.props.auth?.user,
            goToRoute: '',
            currentSlide: 0,
        };
    },
    computed: {
        hasPaymentIssues() {
            return !this.user.current_plans?.length || this.user.current_plans?.some((plan) => plan.status === 'past_due');
        },
        images() {
            return this.bgImage;
        },
    },
    methods: {
        determineRedirectRoute() {
            if (!this.user&&!this.$page.url.startsWith('/get-started')) {
                return route('get-started')+'#pricing';
            }
            if (!this.user&&this.$page.url.startsWith('/get-started')) {
                return route('auth.account');
            }
            if (this.user&&this.$page.url.startsWith('/get-started')) {
                return route('settings.subscriptions');
            }
            if (this.user && !this.user.current_plans.length) {
                return route('auth.payment');
            }
            if (this.user && this.user.current_plans.length > 0) {
                return route('settings.subscriptions');
            }
            if (this.user && this.hasPaymentIssues) {
                return route('settings.payment-methods');
            }
            return null;
        },
        handleSlideChange() {
            this.currentSlide += 1;
        },
    },
    created() {
        this.goToRoute = this.determineRedirectRoute();
    }
};
</script>

<style scoped>
@keyframes textUp {
    from {
        transform: translateY(20%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes buttonUp {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.animate-text-up {
    animation: textUp 2s ease-out forwards;
}

.animate-button-up {
    animation: buttonUp 2s ease-out forwards;
}

.text-shadow {
    text-shadow:
        0px 8px 16px rgba(0, 0, 0, 0.3),
        0px 16px 32px rgba(0, 0, 0, 0.2),
        8px 8px 32px rgba(0, 0, 0, 0.5),
        16px 16px 64px rgba(0, 0, 0, 0.4),
        24px 24px 96px rgba(0, 0, 0, 0.3);
}
</style>
