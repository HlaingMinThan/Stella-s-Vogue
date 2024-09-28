<template>
    <div class="px-5">
        <h1 class="text-center text-2xl font-semibold mt-5">{{ data.title }}</h1>


        <div class="my-8">
            <ul class="space-y-4 list-disc ps-10">
                <li>
                    Starting at 795 THB per month
                </li>
                <li>
                    Coverage for You and Your Family: Your spouse and dependents are all included
                    under the plan.
                </li>
                <li>
                    Unlimited Legal Consultations: Speak with your lawyer as often as needed about
                    any personal legal issues you face.
                </li>
                <li>
                    Unlimited Document Reviews: Have your personal legal contracts and
                    documents reviewed without any limits.
                </li>
                <li>
                    24/7 Emergency Legal Assistance: Access a lawyer anytime, day or night, for
                    covered emergency situations.
                </li>
                <li>
                    Risk-Free Enrollment: You can cancel your plan anytime, for any reason, with no
                    penalties.
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
// import InertiaLinkButton from '../Atoms/InertiaLinkButton.vue';

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
