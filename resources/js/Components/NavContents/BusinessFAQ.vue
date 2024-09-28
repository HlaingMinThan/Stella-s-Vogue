<template>
    <div>
        <h1 class="text-center text-2xl font-semibold">{{ data.title }}</h1>


        <div class="my-12">
            <ol class="list-decimal list-inside space-y-6">
                <li class="text-lg font-semibold">What does the Business Plan cover?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            The Business Plan includes unlimited consultations on business-related legal
                            issues, contract review, advice on starting and managing a business in Thailand, and support for
                            legal compliance.
                        </span>
                    </li>
                </ul>



                <li class="text-lg font-semibold mt-10">Can the Business Plan help with setting up a company in Thailand?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            Yes, our Business Plan provides guidance on the process of setting up a company
                            in Thailand, including choosing the right business structure, registering your company, and
                            understanding local regulations.
                        </span>
                    </li>
                </ul>



                <li class="text-lg font-semibold">How does the Business Plan help with contracts and agreements?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            We review business contracts and agreements to ensure they are legally sound
                            and protect your interests. We also offer advice on negotiating terms and resolving disputes.
                        </span>
                    </li>
                </ul>



                <li class="text-lg font-semibold">Is the Business Plan suitable for small businesses?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            Yes, the Business Plan is ideal for businesses of all sizes, including small
                            businesses and startups. We tailor our services to meet the specific needs of your business.
                        </span>
                    </li>
                </ul>


                <li class="text-lg font-semibold">Can I get help with employment law under the Business Plan?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            Yes, the Business Plan includes advice on employment law, helping you navigate
                            hiring, employee contracts, and compliance with Thai labor laws.
                        </span>
                    </li>
                </ul>




                <li class="text-lg font-semibold">What if I have a legal dispute with a business partner or client?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            The Business Plan offers support for resolving business disputes. We provide
                            advice on mediation, negotiation, and other methods to avoid costly litigation.
                        </span>
                    </li>
                </ul>




                <li class="text-lg font-semibold">How can the Business Plan help me stay compliant with Thai laws?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            We offer ongoing support to ensure your business complies with all relevant Thai
                            laws and regulations. This includes advice on taxes, licensing, and regulatory requirements.
                        </span>
                    </li>
                </ul>



                <li class="text-lg font-semibold">Is the Business Plan only for businesses in Thailand?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            While the Business Plan is focused on businesses operating in Thailand, it also
                            provides valuable support for international businesses dealing with Thai partners, clients, or
                            regulations.
                        </span>
                    </li>
                </ul>
            </ol>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
};
</script>

  <style scoped>



  </style>
