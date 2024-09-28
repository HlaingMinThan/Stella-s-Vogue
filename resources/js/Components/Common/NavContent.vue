<template>
    <div class="py-10">
        <component :is="currentComponent" :data="data" />
    </div>
</template>

<script>
import AboutUs from '../NavContents/AboutUs.vue';
import BusinessCoveragePricing from '../NavContents/BusinessCoverage&Pricing.vue';
import BusinessFAQ from '../NavContents/BusinessFAQ.vue';
import BusinessPlanDetails from '../NavContents/BusinessPlanDetails.vue';
import BusinessWhyTLP from '../NavContents/BusinessWhyTLP.vue';
import FAQ from '../NavContents/FAQ.vue';
import PersonalCoveragePricing from '../NavContents/PersonalCoverage&Pricing.vue';
import PersonalFAQ from '../NavContents/PersonalFAQ.vue';
import PersonalPlanDetails from '../NavContents/PersonalPlanDetails.vue';
import PersonalWhyTLP from '../NavContents/PersonalWhyTLP.vue';

export default {
    components: {
        PersonalPlanDetails,
        PersonalWhyTLP,
        PersonalCoveragePricing,
        PersonalFAQ,
        BusinessPlanDetails,
        BusinessWhyTLP,
        BusinessFAQ,
        AboutUs,
        FAQ
    },
    props: {
        type: {
            type: String,
            required: true
        },
        data: {
            type: Object,
            required: true
        }
    },
    computed: {
        currentComponent() {
            const componentMap = {
                'personal-plan-details': PersonalPlanDetails,
                'personal-coverage&pricing' : PersonalCoveragePricing,
                'personal-whyTLP' : PersonalWhyTLP,
                'personal-FAQ' : PersonalFAQ,
                'business-plan-details' : BusinessPlanDetails,
                'business-coverage&pricing' : BusinessCoveragePricing,
                'business-whyTLP' : BusinessWhyTLP,
                'business-FAQ' : BusinessFAQ,
                'about-us' : AboutUs,
                'faq' : FAQ
            };
            return componentMap[this.type] || null;
        }
    }
};
</script>

  <style scoped>
  /* Add styles if needed */
  </style>
