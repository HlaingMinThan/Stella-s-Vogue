<template>
    <div>
        <h1 class="text-center text-2xl font-semibold">{{ data.title }}</h1>

        <div class="mt-12">
            <ul class="list-disc ps-10 space-y-4">
                <li>More time to consult with your professional legal advisor</li>
                <li>Comprehensive document review and drafting tailored to Thai law</li>
                <li>A wide range of standard legal services included with your membership</li>
                <li>Expert legal guidance across multiple areas of Thai law</li>
                <li>Seasoned lawyers with an average of 20 years of experience</li>
                <li>Exclusive member perks and discounts that can cover your plan costs</li>
            </ul>
        </div>

        <div class="my-12">
            <h2 class="text-xl font-semibold">4 Reasons Thai Legal Protection is Your Top Choice</h2>
            <p class="my-6">
                A legal plan from Thai Legal Protection offers numerous benefits that stand out from the rest. We've condensed the top advantages our clients appreciate most :
            </p>


            <div class="my-12 px-5 py-3">

                <ol class="list-decimal space-y-6">
                    <li class="text-lg font-semibold">Prepaid legal plans can save you substantial
                        costs compared to hiring a lawyer directly.</li>
                    <ul class="list-disc  ps-10 space-y-8">
                        <li class="">
                            <span>
                                Instead of paying high hourly rates for
                                professional legal advice, you can
                                access expert guidance with a small
                                monthly fee starting at just [insert
                                amount]. Say goodbye to the stress of
                                billable hours—consult with our
                                experienced advisors as often as
                                needed without worrying about extra
                                charges. Our prepaid legal plan includes
                                essential services like contract reviews, financial consultations, and
                                personalized advice on Thai banking
                                and financial law. These services alone
                                could cost thousands if you hired a
                                lawyer directly.
                            </span>
                        </li>
                        <li>
                            <span>
                                With Thai Legal Protection, you get
                                expert support at a fraction of the cost, ensuring your financial matters are
                                handled with care and professionalism.
                            </span>
                        </li>
                    </ul>

                    <li class="text-lg font-semibold">
                        <span>
                            Thai Legal Protection has been at the
                            forefront of providing expert legal guidance
                            in Thailand, continuously enhancing our services to better meet our clients' needs.
                        </span>
                    </li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                Founded with the mission to make
                                professional legal advice accessible
                                and affordable, Thai Legal Protection
                                has built a strong reputation for
                                excellence. We understand the
                                complexities of Thai law and offer a
                                network of seasoned advisors and
                                consultants who specialize in various
                                legal fields.
                            </span>
                        </li>

                        <li>
                            <span>
                                Our commitment to quality has led us
                                to develop a comprehensive range of
                                services, allowing individuals and
                                businesses to access professional legal
                                support for a small, predictable fee. Whether it's navigating Thai
                                regulations, drafting crucial
                                documents, or providing ongoing legal
                                advice, our team is here to ensure
                                you’re protected.
                            </span>
                        </li>

                        <li>
                            <span>
                                With thousands of satisfied clients and
                                a team of lawyers with an average of
                                20 years of experience, Thai Legal
                                Protection stands out as a trusted
                                partner for anyone needing reliable
                                legal guidance in Thailand.
                            </span>
                        </li>
                    </ul>



                    <li class="text-lg font-semibold">Thai Legal Protection offers you
                        incredible value that goes beyond expert
                        legal advice.</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                We’ve partnered with top brands
                                and organizations to provide
                                exclusive discounts on products and
                                services you already use. These
                                savings alone can cover your entire
                                monthly fee!
                            </span>
                        </li>

                        <li>
                            <span>
                                It might sound too good to be true, but it’s not. By taking advantage of just a few of these discounts, you
                                can easily offset the cost of your
                                membership. And when you add in
                                the professional guidance from our
                                seasoned advisors, your
                                membership practically pays for
                                itself.
                            </span>
                        </li>

                        <li>
                            <span>
                                Whether you need legal
                                consultation or simply want to save
                                on everyday expenses, Thai Legal
                                Protection delivers unmatched
                                value for your peace of mind.
                            </span>
                        </li>
                    </ul>




                    <li class="text-lg font-semibold">Thai Legal Protection: The Clear Leader in
                        Financial and Legal Guidance</li>
                    <ul class="list-disc ps-10 space-y-4">
                        <li class="">
                            <span>
                                When you compare the value and quality
                                of our services to others, it’s clear that
                                Thai Legal Protection stands in a league of
                                its own. Our expert advisors and
                                consultants offer unparalleled guidance
                                under Thai law, making us the smart
                                choice for individuals and businesses alike.
                            </span>
                        </li>

                        <li>
                            <span>
                                Unlike others who claim to provide similar
                                services, we surpass them in every measure—thanks to our commitment to
                                continuous improvement and deep
                                expertise developed over 20 years. We've
                                worked tirelessly to refine our offerings, ensuring you receive the best possible
                                advice and support.
                            </span>
                        </li>

                        <li>
                            <span>
                                Thai Legal Protection isn’t just a better
                                option—it’s the recognized leader in the
                                industry, trusted by clients to deliver
                                superior results. Choose us for your
                                financial and legal needs and experience
                                the difference yourself.
                            </span>
                        </li>
                    </ul>
                </ol>
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

  .outer-border {
    border: 2px solid #d1d5db; /* Gray-300 */
}
.outer-border td,
.outer-border th {
    border: none;
}

  </style>
