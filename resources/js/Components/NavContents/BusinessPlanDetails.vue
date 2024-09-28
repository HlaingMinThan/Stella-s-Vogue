<template>
    <div class="px-5">
        <h1 class="text-center text-2xl font-semibold">{{ data.title }}</h1>

        <h5 class="text-lg font-semibold mt-10 mb-5">
            Empower Your Business with Thai Legal Protection
        </h5>

        <p class=" mb-8">
            Running a business in Thailand comes with its own set of challenges, especially when it comes
            to navigating the local legal landscape. Our Business Plan is designed to provide you with the
            legal support you need to run your business smoothly and successfully.
        </p>


        <div class="mt-16">
            <h2 class="text-xl font-semibold">What’s Included in the Business Plan?</h2>

            <div class="my-8">
                <ol class="list-decimal list-inside space-y-4">
                    <li class="text-lg font-semibold">Unlimited Consultations</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Ongoing access to our legal team for advice on any business- related legal issues. From contracts to compliance, we’re here to support your business.
                            </span>
                        </li>
                        <li>
                            <span>
                                How It Works: Whenever you need assistance, just contact us to schedule a
                                consultation. We’ll provide the expert guidance you need.
                            </span>
                        </li>
                    </ul>

                    <li class="text-lg font-semibold">Company Formation Assistance</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Help with setting up a new business in Thailand, including advice
                                on choosing the right business structure and registering your company.
                            </span>
                        </li>

                        <li>
                            <span>
                                How It Works: We’ll guide you through the entire process, ensuring your
                                business is set up correctly from the start.
                            </span>
                        </li>
                    </ul>



                    <li class="text-lg font-semibold">Contract Review & Drafting</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Professional review and drafting of business contracts to protect
                                your interests and ensure compliance with Thai law.
                            </span>
                        </li>

                        <li>
                            <span>
                                How It Works: Provide us with your contracts or agreements, and we’ll review or
                                draft them to meet your specific needs.
                            </span>
                        </li>
                    </ul>




                    <li class="text-lg font-semibold">Employment Law Support</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Advice on hiring practices, employee contracts, and compliance
                                with Thai labor laws, helping you avoid potential legal issues.
                            </span>
                        </li>

                        <li>
                            <span>
                                How It Works: We’ll provide you with clear guidelines and assistance to ensure
                                your employment practices are legally sound.
                            </span>
                        </li>
                    </ul>


                    <li class="text-lg font-semibold">Legal Compliance & Regulatory Advice</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Guidance on staying compliant with all relevant Thai laws and
                                regulations, including tax, licensing, and other business requirements.
                            </span>
                        </li>

                        <li>
                            <span>
                                How It Works: We’ll keep you informed of any changes in the law and help you
                                take the necessary steps to remain compliant.
                            </span>
                        </li>
                    </ul>



                    <li class="text-lg font-semibold">Dispute Resolution & Negotiation</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Support for resolving business disputes, whether with partners, clients, or suppliers, without the need for costly litigation.
                            </span>
                        </li>

                        <li>
                            <span>
                                How It Works: We’ll help you explore negotiation or mediation as alternatives to
                                court, providing advice to reach a fair settlement.
                            </span>
                        </li>
                    </ul>
                </ol>

            </div>


            <div class="mt-16 space-y-4">
                <h2 class="text-xl font-semibold">Why Choose Our Business Plan?</h2>

                <ul class="list-disc ps-10 space-y-4">
                    <li>
                        Expert Support: Our legal team has extensive experience in Thai business law.
                    </li>
                    <li>
                        Compliance Made Easy: We help you navigate complex regulations, so you can
                        focus on growing your business.
                    </li>
                    <li>
                        Cost-Effective: Avoid expensive legal battles with our proactive dispute
                        resolution support.
                    </li>
                    <li>
                        Peace of Mind: Know that your business is legally protected, allowing you to
                        operate with confidence.
                    </li>
                </ul>
            </div>
        </div>

        <div class="lg:mb-8 mb-24">
            <!-- <InertiaLinkButton :href="route('personal-plan.converage-and-pricing')" class="bg-primary text-white mt-8">
                Get Started ( Personal Plan )
            </InertiaLinkButton> -->
            <InertiaLinkButton @click="handleClick" class="bg-primary text-white mt-8">
                Get Started ( Business Plan )
            </InertiaLinkButton>
        </div>
    </div>
</template>

<script>

// import { Inertia } from '@inertiajs/inertia';
import InertiaLinkButton from '../Atoms/InertiaLinkButton.vue';

export default {
    components: {
        InertiaLinkButton
    },
    props: {
        data: {
            type: Object,
            required: true
        }
    },

    methods: {
        handleClick() {
            window.location.href = '/business-plan/coverage-and-pricing';
        }
    }
};
</script>

  <style scoped>



  </style>
