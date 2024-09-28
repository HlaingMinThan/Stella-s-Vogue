<template>
    <div>
        <h1 class="text-center text-2xl font-semibold">{{ data.title }}</h1>


        <div class="my-12">
            <ol class="list-decimal list-inside space-y-6">
                <li class="text-lg font-semibold">What is included in the Personal Plan?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            The Personal Plan includes unlimited consultations on legal and visa matters, document review, advice on personal legal issues like family law or property, and guidance on
                            handling legal matters yourself to save costs.
                        </span>
                    </li>
                </ul>



                <li class="text-lg font-semibold mt-10">Can I get help with my visa application through the Personal Plan?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            Yes, the Personal Plan covers assistance with various visa applications, including
                            tourist, retirement, marriage, and work visas. We guide you through the process and review
                            your documents to ensure everything is correct.
                        </span>
                    </li>
                </ul>



                <li class="text-lg font-semibold">Do I need to visit your office to use the Personal Plan?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            No, you can access all services in the Personal Plan remotely. Consultations are
                            conducted over the phone or online, making it convenient for you to get help from anywhere.
                        </span>
                    </li>
                </ul>



                <li class="text-lg font-semibold">How does the Personal Plan help me save money?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            Our experts provide advice on handling some legal tasks yourself, which reduces
                            the need for costly legal services. We also help you avoid unnecessary court cases by offering
                            alternative solutions.
                        </span>
                    </li>
                </ul>


                <li class="text-lg font-semibold">What types of legal issues are covered under the Personal Plan?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            The Personal Plan covers a wide range of personal legal issues, including family
                            law, property law, wills and estate planning, and more. We provide advice and support tailored
                            to your specific needs.
                        </span>
                    </li>
                </ul>




                <li class="text-lg font-semibold">Can I get a second opinion on legal advice I’ve already received?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            Yes, the Personal Plan includes second opinions on any legal advice or
                            documents you have received. Our experts will review everything and give you their
                            professional opinion.
                        </span>
                    </li>
                </ul>




                <li class="text-lg font-semibold">How quickly can I get help with a legal issue under the Personal Plan?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            We strive to provide quick and timely support. After you contact us, we will
                            arrange a consultation as soon as possible, usually within 24 hours.
                        </span>
                    </li>
                </ul>



                <li class="text-lg font-semibold">Is the Personal Plan suitable for someone living outside of Thailand?</li>
                <ul class="list-disc ps-10 space-y-4">
                    <li class="">
                        <span>
                            Yes, the Personal Plan is designed to assist both residents and non-residents. Whether you live in Thailand or abroad, you can access our services and get the legal support
                            you need.
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
