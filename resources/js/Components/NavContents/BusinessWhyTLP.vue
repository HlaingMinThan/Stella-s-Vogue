<template>
    <div>
        <h1 class="text-center text-2xl font-semibold">{{ data.title }}</h1>


        <p class="my-12">
            All of these situations involve legal complexities that can have serious implications for your
            business if not managed properly. Thai Legal Protection offers expert guidance and professional
            advice tailored to the nuances of Thai law. Whether you need a consultant to navigate legal
            challenges or an advisor to ensure compliance, our team is here to help you avoid costly issues
            and protect your interests. Let us guide you through the legal landscape with confidence and
            clarity.
        </p>

        <div class="space-y-4">
            <h5 class="text-xl font-semibold">Consider these scenarios...</h5>

            <ul class="list-disc list-inside space-y-4 ps-5">
                <li>Had to hire or terminate an employee?</li>
                <li>Faced a conflict with a vendor or customer?</li>
                <li>Needed a lawyer to draft a letter or make a crucial phone call?</li>
                <li>Required legal advice on a contract review?</li>
                <li>Worried about your business facing a lawsuit?</li>
            </ul>


            <div class="space-y-4 mt-5">
                <p>
                    Each of these scenarios involves legal challenges that, if not handled properly, could have
                    serious consequences for your business.
                </p>

                <p>
                    A recent study revealed that 60% of business owners encountered at least one significant legal
                    issue in the past year. Unfortunately, most tried to handle it themselves, fearing the high cost
                    of hiring a lawyer. The average expense for legal services? THB 250,000 per incident. Even when
                    business owners did seek legal help, many struggled to find a responsive and effective lawyer.
                </p>

                <p>
                    Thai Legal Protection is here to change that. Our team of professional advisors and consultants
                    is equipped to guide you through the complexities of Thai law, ensuring your business is
                    protected. We offer accessible, expert legal support, helping you navigate challenges without
                    the prohibitive costs. Let us be your trusted legal partner in Thailand.
                </p>
            </div>
        </div>

        <div class="my-12">
            <h5 class="text-xl font-semibold my-4">Thai Legal Protection leads the way.</h5>

            <div class="space-y-4">
                <p>
                    With a tailored legal plan from Thai Legal Protection, you can access expert legal advice and
                    support without the overwhelming costs. We specialize in navigating the complexities of Thai
                    law, offering the most comprehensive legal benefits available.
                </p>

                <p>
                    Our team of seasoned advisors and consultants ensures you receive professional guidance
                    every step of the way. We’ve refined our services to meet the unique needs of businesses
                    operating in Thailand.
                </p>

                <p>
                    You can adjust or cancel your plan at any time with 30 days’ notice through a simple written
                    request, email, or phone call—no risk involved.
                </p>


                <p>
                    Don’t let legal challenges jeopardize your business. Trust Thai Legal Protection to help you
                    manage them effectively.
                </p>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    components: {
        // InertiaLinkButton
    },
    props: {
        data: {
            type: Object,
            required: true
        }
    }
};
</script>

  <style scoped>



  </style>
