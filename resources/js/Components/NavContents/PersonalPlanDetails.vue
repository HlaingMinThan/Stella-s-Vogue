<template>
    <div class="px-5">
        <h1 class="text-center text-2xl font-semibold">{{ data.title }}</h1>

        <p class="my-8">
            Protect Your Personal Interests with Thai Legal Protection
            At Thai Legal Protection, we know that dealing with legal matters can be stressful, especially if
            you’re not familiar with the laws in Thailand. Our Personal Plan is designed to make things
            simple, clear, and manageable. We provide the guidance you need to handle your legal and visa
            matters with confidence.
        </p>


        <div class="mt-16">
            <h2 class="text-xl font-semibold">What’s Included in the Personal Plan?</h2>

            <div class="my-8">
                <ol class="list-decimal list-inside space-y-4">
                    <li class="text-lg font-semibold">Unlimited Consultations</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Access to our legal experts whenever you need advice. Whether
                                you have questions about a contract, a visa application, or a legal issue, we’re here to help.
                            </span>
                        </li>
                        <li>
                            <span>
                                How It Works: Simply contact us to schedule a consultation, and one of our
                                experts will be ready to assist you.
                            </span>
                        </li>
                    </ul>

                    <li class="text-lg font-semibold">Visa Assistance</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Help with applying for, extending, or renewing various types of
                                Thai visas, including tourist, retirement, marriage, and work visas.
                            </span>
                        </li>

                        <li>
                            <span>
                                How It Works: We guide you through the entire process, ensuring all your
                                documents are in order and submitted correctly.
                            </span>
                        </li>
                    </ul>



                    <li class="text-lg font-semibold">Legal Document Review</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Detailed review of legal documents such as contracts, agreements, or leases to ensure they protect your interests.
                            </span>
                        </li>

                        <li>
                            <span>
                                How It Works: Send us your documents, and we’ll carefully review them, providing feedback and advice on any potential issues.
                            </span>
                        </li>
                    </ul>




                    <li class="text-lg font-semibold">Second Opinions</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: A professional review of any legal advice or documents you’ve
                                already received, giving you peace of mind.
                            </span>
                        </li>

                        <li>
                            <span>
                                How It Works: We’ll assess the information you’ve been given and provide our
                                expert opinion, ensuring you make informed decisions.
                            </span>
                        </li>
                    </ul>


                    <li class="text-lg font-semibold">Guidance on Handling Legal Matters Yourself</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Step-by-step advice on how to handle certain legal tasks on your
                                own, saving you time and money.
                            </span>
                        </li>

                        <li>
                            <span>
                                How It Works: We’ll explain the process and provide you with the necessary
                                tools and knowledge to complete the task yourself, without needing to hire additional legal
                                help.
                            </span>
                        </li>
                    </ul>



                    <li class="text-lg font-semibold">Dispute Resolution Support</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                What You Get: Advice on resolving personal disputes, whether with landlords, employers, or other parties, without the need to go to court.
                            </span>
                        </li>

                        <li>
                            <span>
                                How It Works: We’ll help you explore options like negotiation or mediation, guiding you through the steps to reach a fair resolution.
                            </span>
                        </li>
                    </ul>
                </ol>

            </div>


            <div class="mt-16 space-y-4">
                <h2 class="text-xl font-semibold">Why Choose Our Personal Plan?</h2>

                <ul class="list-disc ps-10 space-y-4">
                    <li>
                        Simplicity: We make complex legal matters easy to understand and manage.
                    </li>
                    <li>
                        Support: Our experts are always available to answer your questions and guide
                        you.
                    </li>
                    <li>
                        Savings: Handle certain legal tasks yourself, reducing the need for expensive
                        legal services.
                    </li>
                    <li>
                        Peace of Mind: Know that you have a trusted legal partner to help you navigate
                        challenges.
                    </li>
                </ul>
            </div>
        </div>

        <div class="lg:mb-8 mb-24">
            <!-- <InertiaLinkButton :href="route('personal-plan.converage-and-pricing')" class="bg-primary text-white mt-8">
                Get Started ( Personal Plan )
            </InertiaLinkButton> -->
            <InertiaLinkButton @click="handleClick" class="bg-primary text-white mt-8">
                Get Started ( Personal Plan )
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
            window.location.href = '/personal-plan/coverage-and-pricing';
        }
    }
};
</script>

  <style scoped>



  </style>
